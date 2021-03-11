<?php

namespace App\Services;

use App\{Serie, Temporada, Episodio};
use Illuminate\Support\Facades\DB;

class RemovedorDeSerie
{
    public function removerSerie(int $serieId): Serie
    {
        $serie = new Serie();
        DB::transaction(function () use ($serieId, &$serie){
            $serie = Serie::find($serieId);
            $this->removerTemporada($serie);
            $serie->delete();
        });


        return $serie;
    }

    private function removerTemporada(Serie $serie){
            $serie->temporadas->each(function (Temporada $temporada) {
            $this->removerEpisodio($temporada);
            $temporada->delete();
        });
    }

    private function removerEpisodio(Temporada $temporada){
        $temporada->episodios->each(function (Episodio $episodio) {
            $episodio->delete();
        });
    }
}
