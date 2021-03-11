<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model{
    protected $table = 'series'; //por default o laravel poe o nome da classe em minusculo e no plural, então essa declaração é desnessaria nesse caso. Mas anotei caso precise consultar futuramente
    public $timestamps = false; //evita o erro do laravel tentar salvar os timestamps em uma tabela que não as tem, ignorando assim essa informação
    protected $fillable = ['nome'];

    public function temporadas(){
        return $this->hasMany(Temporada::class);
    }
}