<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleType;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articleTypes = ArticleType::pluck('title', 'id');
        return view('articles.create', compact('articleTypes', $articleTypes));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = Article::create([
            'title' => $request->title,
            'type_id' => $request->type,
            'body' => $request->body,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('article.index')->with('success', 'مطلب با موفقیت ذخیره شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $articleTypes = ArticleType::pluck('title', 'id');
        //$articleType = ArticleType::where('id', $article->type_id)->get();
        // dd($articleTypes);
        return view('articles.edit', compact('article', 'articleTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article['title'] = $request['title'];
        $article['type_id'] = $request['type'];
        $article['body'] = $request['body'];
        $article->save();
        return redirect('/article/' . $article->id)->with('success', 'مطلب با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('article.index')
            ->with('success', 'مطلب ' . $article->title . 'حذف شد.');
    }
}
