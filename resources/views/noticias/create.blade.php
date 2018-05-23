@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h2>Adicionar Notícia</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="{{  route('noticias.index') }}" class="btn btn-secondary">Lista de Notícias</a>
            </div>
        </div>
        <div class="row my-3">
            <div class="col">
                <div id="root">
                    <Container />
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/create-noticia.js') }}"></script>
@endsection