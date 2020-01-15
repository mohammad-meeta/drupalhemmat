<?php

namespace App\Http\Controllers;


use App\IndicatorCategory;
use App\Http\Resources\IndicatorCategoryStore;
use App\Http\Resources\IndicatorCategoryResource;
use App\Http\Resources\IndicatorCategoryCollection;
use Illuminate\Http\Request;

class IndicatorCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('indicator_categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('indicator_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $indicatorCategory = IndicatorCategory::create([
            'title' => $request->title,
            'status' => $request->status
        ]);

        $indicatorCategory = new IndicatorCategoryStore($indicatorCategory);

        return [
            "success" => !is_null($indicatorCategory),
            "data" => $indicatorCategory
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IndicatorCategory  $indicatorCategory
     * @return \Illuminate\Http\Response
     */
    public function show(IndicatorCategory $indicatorCategory)
    {
        $indicatorCategory = new IndicatorCategoryResource($indicatorCategory);

        return [
            "success" => true,
            "data" => $indicatorCategory
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IndicatorCategory  $indicatorCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(IndicatorCategory $indicatorCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IndicatorCategory  $indicatorCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IndicatorCategory $indicatorCategory)
    {
        $indicatorCategory['title'] = $request['title'];
        $indicatorCategory['status'] = $request['status'];
        $indicatorCategory->save();

        $indicatorCategory = new IndicatorCategoryStore($indicatorCategory);

        return [
            "success" => !is_null($indicatorCategory),
            "data" => $indicatorCategory
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IndicatorCategory  $indicatorCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(IndicatorCategory $indicatorCategory)
    {
        //
    }

    /**
     * Get indicator category list
     */
    public function indicatorCategoriesList()
    {
        $list = IndicatorCategory::select(['id', 'title', 'status'])
            ->paginate(parent::PAGE_SIZE);

        $list = new IndicatorCategoryCollection($list);

        return $list;
    }
}
