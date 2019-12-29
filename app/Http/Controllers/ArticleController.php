<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleType;
use App\File;
use Auth;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleStore;
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
        return view('articles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { }

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
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'type_id' => $request->type,
            'status' => $request->status
        ]);

        $article->load('type');
        $article->load('files');
        $article = new ArticleStore($article);

        return [
            "success" => !is_null($article),
            "data" => $article
        ];


        /*   $article = Article::create([
            'title' => $request->title,
            'type_id' => $request->type,
            'body' => $request->body,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('article.index')->with('success', 'مطلب با موفقیت ذخیره شد');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $article->load(['type', 'files']);

        return [
            "success" => true,
            "data" => $article
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    { }

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
        $article['status'] = $request['status'];
        $article->save();

        $article->load('type');

        $article = new ArticleStore($article);

        return [
            "success" => !is_null($article),
            "data" => $article
        ];

        /*    $article['title'] = $request['title'];
        $article['type_id'] = $request['type'];
        $article['body'] = $request['body'];
        $article->save();
        return redirect('/article/' . $article->id)->with('success', 'مطلب با موفقیت ویرایش شد.');*/
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

    /**
     * Get articles list
     */
    public function articlesList()
    {
        $list = Article::with(['type', 'files'])
            ->paginate(parent::PAGE_SIZE);

        return $list;
    }

    /**
     * Get documents center list
     */
    public function documentsCenterList()
    {
        $condition = [
            ['type_id', '1'],
            ['status', true]
        ];

        $list = Article::with('type')
            ->where($condition)
            ->paginate(parent::PAGE_SIZE);

        return $list;
    }

    /**
     * Add an attachment to a article
     */
    public function addAttachment(Request $request, Article $article)
    {
        /*  TODO: DATA VALIDATION */

        $file = $request->file;
        $newFile = $article->addAttachment($file);

        return [
            "success" => true,
            "data" => $newFile
        ];
    }

    /**
     * Store file
     */
    public function storeFile(Request $request)
    {
        $data = [
            'original_name' => $request->getClientOriginalName(),
            'name' => $request->name,
            'extension' => $request->extension
        ];

        $file = File::create($data);
        $file = new FileStore($file);

        return [
            "success" => !is_null($file),
            "data" => $file
        ];
    }
}
