<?php

namespace App\Services;

use App\Serie;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{
    public function criarSerie(
        string $nomeSerie,
        int $qtdTemporadas,
        int $qtdEpisodios
    ): Serie {
        $serie = new Serie();
        DB::beginTransaction();
            $serie = Serie::create(['nome' => $nomeSerie]);
            $this->criarTemporada($serie, $qtdTemporadas, $qtdEpisodios);
            $qtdTemporadas = $qtdTemporadas;
        DB::commit();

        return $serie;
    }

    private function criarTemporada($serie, $qtdTemporadas, $qtdEpisodios)
    {
        for ($i = 1; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);
            $this->criarEpsodios($temporada, $qtdEpisodios);
        }
    }

    private function criarEpsodios($temporada, $qtdEpisodios)
    {
        for ($j = 1; $j <= $qtdEpisodios; $j++) {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}
