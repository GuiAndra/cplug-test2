<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Noticias;
use App\Tags_Noticias;
use App\Categorias;
use App\Tags;
use Carbon\Carbon;

class NoticiasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categorias = Categorias::all();
        $tags = Tags::all();
        $noticias = new Noticias;

        if($request->has('categoria_id') && $request->all()['categoria_id']){
            $noticias = $noticias->where('categoria_id', $request->all()['categoria_id']);
        }

        if($request->has('tag_id') && $request->all()['tag_id']){
            $tag_id = $request->all()['tag_id'];
            $noticias = $noticias->whereHas('tags', function($query) use($tag_id){
                $query->where('tag_id', '=', $tag_id);
            });
        }

        $noticias = $noticias->paginate(5);
        
        return view('noticias.index', compact('noticias', 'categorias', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('noticias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $noticia = Noticias::create($request->all());

        if($request->has('tags')){
            foreach($request->all()['tags'] as $tag){
                Tags_Noticias::create(['noticia_id' => $noticia->id, 'tag_id' => $tag]);
            }
        }
        if($request->has('imagens')){
            foreach($request->all()['imagens'] as $image){
                $imageData = $image;
                $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                \Image::make($image)->save(public_path('images/').$fileName);
                $noticia->imagens()->create(['url' => $fileName]);
            }
        }

        return response()->json(['created' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $noticia = Noticias::findOrFail($id);
        return view('noticias.show', compact('noticia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $noticia = Noticias::findOrFail($id);
        return view('noticias.edit', compact('noticia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $noticia = Noticias::findOrFail($id);
        $noticia->update($request->all());

        return redirect(route('noticias.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $noticia = Noticias::findOrFail($id);
        $noticia->delete();
        return response()->json(['deleted' => 'success']);
    }
}
