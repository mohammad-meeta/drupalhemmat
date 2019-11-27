<?php

namespace App\Http\Controllers;

use App\ArticleType;
use Illuminate\Http\Request;

class ArticleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articleTypes = ArticleType::all();
        return view('article_types.index', compact('articleTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $articleType = ArticleType::create([
            'title' => $request->title
        ]);
        return redirect('/article-type')->with('success', 'نوع مطلب با موفقیت ذخیره شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ArticleType  $articleType
     * @return \Illuminate\Http\Response
     */
    public function show(ArticleType $articleType)
    {
        return view('article_types.show', compact('articleType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ArticleType  $articleType
     * @return \Illuminate\Http\Response
     */
    public function edit(ArticleType $articleType)
    {
        return view('article_types.edit', compact('articleType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ArticleType  $articleType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArticleType $articleType)
    {
        $articleType->update($request->all());
        return redirect('/article-type/' . $articleType->id)->with('success', 'نوع مطلب با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ArticleType  $articleType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArticleType $articleType)
    {
        $articleType->delete();
        return redirect()->route('article-type.index')
            ->with('success', 'نوع مطلب' . $articleType->title . 'حذف شد.');
    }
}
