<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreArticleRequest;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Articles::with('categorie', 'user')->latest()->get() ;
        return view('articles.index', compact('articles')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all() ; 
        return view('articles.create', compact('categories')) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        $imageName = $request->image->store('articles') ;

        Articles::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imageName
        ]) ;

        return redirect()->route('dashboard')->with('success', 'Votre post a ete cree !') ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function show(Articles $article)
    {
        return view('articles.show', compact('article')) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function edit(Articles $article)
    {
        if(Gate::denies('update-article', $article)){
            abort(403) ;
        }
        
        $categories = Categories::all() ; 
        return view('articles.edit', compact('article', 'categories')) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function update(StoreArticleRequest $request, Articles $article)
    {
        $arrayUpdate = [
            'title' => $request->title,
            'content' => $request->content 
        ] ;

        if($request->image !== null ){
            $imageName = $request->image->store('articles') ;
            $arrayUpdate = array_merge($arrayUpdate, [
                'image' => $imageName 
            ]) ;
        }

        $article->update($arrayUpdate) ;

        return redirect()->route('dashboard')->with('success', 'Votre post a ete modifie !') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articles $article)
    {
        if(Gate::denies('destroy-article', $article)){
            abort(403) ;
        }

        $article->delete() ;

         return redirect()->route('dashboard')->with('success', 'Votre post a ete supprimer !') ;
    }
}
