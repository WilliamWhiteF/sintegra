<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sintegra extends Model
{
    public $table = 'sintegra';

    protected $fillable = [
        'cnpj', 'json'
    ];

    protected $date = [
        'created_at', 'updated_at'
    ];

    public function getCnpjAttribute($value)
    {
        return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $value);
    }

    public function setCnpjAttribute($value)
    {
        $this->attributes['cnpj'] = str_replace(['.', '/', '-'], '', $value);
    }

    public function usuario()
    {
        return $this->belongsTo(\App\Models\Usuario::class, 'id_usuario');
    }
}
