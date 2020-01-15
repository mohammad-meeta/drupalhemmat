<?php

namespace App\Http\Controllers;

use App\DocumentCategory;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleTypeStore;
use App\Http\Resources\DocumentCategoryStore;

class DocumentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('document_categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('document_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $documentCategory = DocumentCategory::create([
            'title' => $request->title
        ]);
        $documentCategory = new DocumentCategoryStore($documentCategory);

        return [
            "success" => !is_null($documentCategory),
            "data" => $documentCategory
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DocumentCategory  $documentCategory
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentCategory $documentCategory)
    {
        return view('document_categories.show', compact('documentCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DocumentCategory  $documentCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentCategory $documentCategory)
    {
        return view('document_categories.edit', compact('documentCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DocumentCategory  $documentCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DocumentCategory $documentCategory)
    {
        $documentCategory['title'] = $request['title'];
        $documentCategory->save();


        $documentCategory = new DocumentCategoryStore($documentCategory);

        return [
            "success" => !is_null($documentCategory),
            "data" => $documentCategory
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DocumentCategory  $documentCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentCategory $documentCategory)
    {
        //
    }

    /**
     * Document category list
     */
    public function documentCategoriesList()
    {
        $list = DocumentCategory::all();

        return $list;
    }
}
