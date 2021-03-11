@extends('layout')

@section('titulo')
    Temporadas de {{$serie->nome}}
@endsection

@section('conteudo')
<ul class="list-group">
    @foreach ($temporadas as $key => $temporada)
    <li class="list-group-item">Temporada {{$temporada->numero}}</li>
    @endforeach
</ul>
@endsection