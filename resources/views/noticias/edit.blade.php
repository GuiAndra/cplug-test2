@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h2>Editar Notícia</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="{{  route('noticias.index') }}" class="btn btn-secondary">Lista de Notícias</a>
            </div>
        </div>
        <div class="row my-3">
            <div class="col"></div>
            <div class="col-md-8">
                <form action="{{ route('noticias.update', $noticia->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input class="form-control" type="text" name="titulo" id="titulo" value="{{ $noticia->titulo }}">
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <input class="form-control" type="text" name="descricao" id="descricao" value="{{ $noticia->descricao }}">
                    </div>
                    <button type="submit" class="btn btn-success float-right">Editar</button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection