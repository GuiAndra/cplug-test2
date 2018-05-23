@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h2>Notícia {{ $noticia->id }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="{{  route('noticias.index') }}" class="btn btn-secondary">Lista de Notícias</a>
            </div>
        </div>
        <div class="row my-3">
            <div class="col"></div>
            <div class="col-md-8 text-center">
                <p>Título: {{ $noticia->titulo }}</p>
                <p>Descrição: {{ $noticia->descricao }}</p>
            </div>
            <div class="col"></div>
        </div>
        <div class="row my-5">
            <div class="col">
                @foreach ($noticia->imagens as $imagem)
                    <img src="{{ asset('images/'.$imagem->url) }}" class="img-fluid" alt="" style="max-width: 15em; max-height: 15em;" />
                @endforeach
            </div>
        </div>
    </div>
@endsection