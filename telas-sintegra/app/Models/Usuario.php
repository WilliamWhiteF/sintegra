<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use Notifiable;

    public $table = 'usuario';

    protected $fillable = [
        'usuario', 'senha',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function consultas()
    {
        return $this->hasMany(\App\Models\Sintegra::class, 'id_usuario');
    }
}
