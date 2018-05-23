@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h2>Notícias</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="{{  route('noticias.create') }}" class="btn btn-success">Adicionar Notícia</a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <form action="{{ route('noticias.index') }}" method="get">
                    <div class="row">
                        <div class="col">
                            <label>Categoria</label>
                            <select class="form-control" name="categoria_id" onchange="submit()">
                                <option value=""></option>
                                @foreach ($categorias as $categoria)
                                    <option {{ isset($_GET['categoria_id']) && $_GET['categoria_id'] == $categoria->id ? 'selected' : ''}} value="{{ $categoria->id }}">{{ $categoria->titulo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label>Tag</label>
                            <select class="form-control" name="tag_id" onchange="submit()">
                                <option value=""></option>
                                @foreach ($tags as $tag)
                                    <option {{ isset($_GET['tag_id']) && $_GET['tag_id'] == $tag->id ? 'selected' : ''}} value="{{ $tag->id }}">{{ $tag->titulo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
                <table class="table mt-2">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Descrição</th>
                            <th>Categoria</th>
                            <th>Tags</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($noticias as $noticia)
                        <tr>
                            <td>{{ $noticia->titulo }}</td>
                            <td>{{ $noticia->descricao }}</td>
                            <td>{{ $noticia->categoria->titulo }}</td>
                            <td>
                                <ul>
                                    @foreach ($noticia->tags as $tag)
                                        <li>{{ $tag->tag->titulo }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <a href="{{ route('noticias.show', $noticia->id) }}" class="btn btn-outline-success">Exibir</a>
                                <a href="{{ route('noticias.edit', $noticia->id) }}" class="btn btn-outline-warning">Editar</a>
                                <a href="" class="btn btn-outline-danger delete" key="{{ $noticia->id }}">Excluir</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $noticias->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
      $('.delete').click(function (event){
        event.preventDefault()
        let el = $(this)
        if(confirm('Deseja deletar a notícia?')){
          axios.delete('noticias/' + el.attr('key')).then(function (response) {
            if(response.data.deleted === 'success'){
              el.parent().parent().remove()
            }
          });
        }
      });
    </script>
@endsection