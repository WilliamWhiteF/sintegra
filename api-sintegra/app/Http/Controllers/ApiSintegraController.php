<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SintegraParser;
use Ixudra\Curl\Facades\Curl;

class ApiSintegraController extends Controller
{
    public function __construct(SintegraParser $parser)
    {
        $this->parser = $parser;
    }

    public function consulta(Request $request, $cnpj)
    {
        //g-recaptcha-response não é enviada porque ela não é conferida para que o formulario seja validado
        $data = [
            'num_cnpj' => $cnpj,
            'botao' => 'Consultar',
            // 'num_ie' => '',
            // 'g-recaptcha-response' => ''
        ];

        $consulta = Curl::to('http://www.sintegra.es.gov.br/resultado.php')
            ->withData($data)
            ->post();

        $consultaJson = $this->parser->parse($consulta);
        return response($consultaJson);
    }
}
