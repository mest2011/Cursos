<?php

namespace App\Http\Controllers;

use App\Episodio;
use App\Http\Requests\SeriesFormRequest;
use App\Serie;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use App\Temporada;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    // public function __construct() //Faz a verificação de usuario logado em todas as rotas referente a series, caso o usuario não esteja logado redireciona para tela de login do laravel
    // {
    //     $this->middleware('auth');
    // }

    function index(Request $request)
    {

        $series = Serie::query()
            ->orderBy('nome')
            ->get();
        $mensagem = $request->session()->get('mensagem');

        return view('series.index', compact('series', 'mensagem'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request, CriadorDeSerie $criadorDeSerie)
    {
        $serie = $criadorDeSerie->criarSerie(
            $request->nome,
            (int) $request->qtd_temporadas,
            (int) $request->ep_por_temporada
        );

        $request->session()
            ->flash(
                'mensagem',
                "Série {$serie->id} e suar temporadas e episódios doram criadas com sucesso, nome: {$serie->nome}"
            );

        return redirect()->route('listar_series');
    }

    public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie)
    {
        $serie = $removedorDeSerie->removerSerie((int) $request->id);
        $request
            ->session()
            ->flash(
                'mensagem',
                "Série {$serie->nome} removida com sucesso!"
            );

        return redirect()->route('listar_series');
    }

    public function editaNome($id, Request $request)
    {
        $novoNome = $request->nome;
        $serie = Serie::find($id);
        $serie->nome = $novoNome;
        $serie->save();
    }
}
