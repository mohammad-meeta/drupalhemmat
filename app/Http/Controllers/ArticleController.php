<?php

namespace App\Http\Controllers;

use App\Article;
use App\File;
use Auth;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleStore;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleDocumentCollection;

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
        $messages = [
            'title.required' => 'عنوان نباید خالی باشد.',
            'title.unique' => 'عنوان نباید تکراری باشد.',
            'title.max' => 'عنوان طولانی است.',
            'body.required' => 'توضیحات نباید خالی باشد.',
            'type.required' => 'نوع نباید خالی باشد.',
            'status.required' => 'وضعیت نباید خالی باشد.',
        ];
        $rules = [
            'title' => 'required|unique:articles|max:255',
            'body' => 'required',
            'type' => 'required',
            'status' => 'required',
            'documentCategory' => [
                function ($attribute, $value, $fail) use ($request) {
                    $type = $request->input('type');

                    if ($type == '1' && $value == null) {
                        $fail('دسته بندی سند مورد نظر را انتخاب کنید.');
                    }
                },
            ],
            'department' => [
                function ($attribute, $value, $fail) use ($request) {
                    $type = $request->input('type');

                    if ($type == '3' && $value == null) {
                        $fail('قسمت مورد نظر را انتخاب کنید');
                    }
                },
            ],
        ];
        $this->validate($request, $rules, $messages);



        $article = Article::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'type_id' => $request->type,
            'document_category_id' => $request->documentCategory,
            'department' => $request->department,
            'status' => $request->status
        ]);

        $article->load('type');
        $article->load('documentCategory');
        $article->load('files');
        $article = new ArticleStore($article);

        return [
            "success" => !is_null($article),
            "data" => $article
        ];

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $article->load(['type', 'documentCategory', 'files']);
        $article = new ArticleResource($article);

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

        $request->validate([
            'title' => 'required|unique:articles|max:255',
            'body' => 'required',
            'type_id' => 'required',
            'status' => 'required',
            'department' => 'not_in:-1'
        ]);

  /*      $validator = Validator::make($request->all(), [
            'department' => [
                'required',
                'max:255',
                function ($attribute, $value, $fail) {
                    if ($value === '-1') {
                        $fail($attribute . ' is invalid.');
                    }
                },
            ],
        ]);*/

        $article['title'] = $request['title'];
        $article['type_id'] = $request['type'];
        $article['document_category_id'] = $request['documentCategory'];
        $article['department'] = $request['department'];
        $article['body'] = $request['body'];
        $article['status'] = $request['status'];
        $article->save();

        $article->files()->detach($request->deletedFiles);

        $article->load(['type', 'documentCategory', 'files']);

        $article = new ArticleStore($article);

        return [
            "success" => !is_null($article),
            "data" => $article
        ];
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
                ->select([ 'id', \DB::raw("'' as body"), 'title', 'status', 'type_id', 'document_category_id' ])
                ->paginate(parent::PAGE_SIZE);

        $list = new ArticleCollection($list);

        return $list;
    }

    /**
     * show documents center index page
     */
    public function documentsCenter()
    {
        return view('articles.documents-center');
    }

    /**
     * Get documents center list
     */
    public function articleDocumentsCenterList()
    {
        $condition = [
            ['status', true]
        ];

        $documentlist = Article::with(['type', 'documentCategory'])
            ->where($condition)
            ->paginate(parent::PAGE_SIZE);

        $documentlist = new ArticleDocumentCollection($documentlist);

        return $documentlist;
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
