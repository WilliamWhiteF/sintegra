<?php

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Usuario para teste
        Usuario::create([
            'usuario' => 'teste',
            'senha' => bcrypt('123'),
            'api_token' => 'MoEvzl56AetuSrg5uWzKGrkfUsu8ML0OStb3gcwnYfmQ8Su7N6Ugsa9osnPW',
        ]);
    }
}
