@extends('layout')

@section('titulo')
Cadastrar Série
@endsection

@section('conteudo')
<form method="POST">
    @csrf
    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" name="nome" id="nome">
    </div>

    <button class="btn btn-primary">Salvar</button>
</form>
@endsection