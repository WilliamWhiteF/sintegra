<?php

namespace App\Models;

class SintegraParser
{
    /**
     * remove as informações desnecessarias da busca na sintegra e retorna um json
     * com os campos da tabela
     * @param  string $text html da pagina de consulta
     * @return string       json com os campos da tabela
     */
    public function parse(string $text): string
    {
        $this->text = utf8_encode($text);
        $this->clearSpaces()
            ->getTable()
            ->removeComments()
            ->removeAttributes()
            ->getFields();

        return $this->text;
    }

    /**
     * Remove espaços, quebras de linha e tabulação.
     */
    private function clearSpaces()
    {
        $this->text = preg_replace('/\s{2,}|\n|\r|\t|&nbsp;/', '', $this->text);
        return $this;
    }

    /**
     * Seleciona apenas a tabela de informações do texto
     */
    private function getTable()
    {
        preg_match('/(<table.+<\/table>)/', $this->text, $table);
        $this->text = $table[1];

        return $this;
    }

    /**
     * Remove os comentarios
     */
    private function removeComments()
    {
        $this->text = preg_replace('/<!--.+-->/', '', $this->text);
        return $this;
    }

    /**
     * Remove os atributos do campo
     */
    private function removeAttributes()
    {
        $this->text = preg_replace('/(width|colspan|cellspacing|border|cellpadding|align)="[\w%]+"/', '', $this->text);
        return $this;
    }

    /**
     * Seleciona os campos e valores do que sobrou após todas as filtragens
     * @return string json contendo as informações do campo
     */
    private function getFields(): string
    {
        preg_match_all('/<td\s+class="titulo"(?:[^>]+)?>([^:]+):<\/td>/', $this->text, $fields);
        preg_match_all('/<td\s+class="valor"(?:[^>]+)?>([^<]+)?<\/td>/', $this->text, $values);

        //Remove os elementos que contem a match total da regex, matendo apenas os valores
        array_shift($fields);
        array_shift($values);

        $result = array_combine($fields[0], $values[0]);

        //adiciona a data de consulta como primeiro elemento
        $data['Data da Consulta'] = date('d/m/Y H:i:s');
        $result = $data + $result;

        $this->text = json_encode($result);
        return $this->text;
    }
}
