<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use App\Models\Sintegra;
use App\Models\Usuario;

use Ixudra\Curl\Facades\Curl;

class ConsultaController extends Controller
{
    public function index()
    {
        return view('consulta.index');
    }

    public function consulta($cnpj)
    {
        $user = Auth::user();
        $consultaJson = Sintegra::where("cnpj", $cnpj)->first(["json"]);

        if ($consultaJson) {
            $consultaJson = json_decode($consultaJson->json);
            return view('consulta.info', compact('consultaJson'));
        }

        // $apiUrl = Config::get('contants.api_sintegra_url');
        $consultaJson = Curl::to("http://localhost:8000/api/sintegra/es/{$cnpj}")
            ->withData(['api_token' => $user->api_token])
            ->get();

        $sintegra = new Sintegra([
            'cnpj' => $cnpj,
            'json' => $consultaJson
        ]);

        $usuario = Usuario::find(Auth::id());
        $usuario->consultas()
            ->save($sintegra);

        $consultaJson = json_decode($consultaJson);
        return view('consulta.info', compact('consultaJson'));
    }

    public function list()
    {
        $consultas = Usuario::find(Auth::id())
            ->consultas()
            ->get();

        return view('consulta.list', compact('consultas'));
    }

    public function delete($cnpj)
    {
        Sintegra::where('cnpj', $cnpj)
            ->delete();

        $responseOk = 200;
        return response('OK', $responseOk);
    }
}
