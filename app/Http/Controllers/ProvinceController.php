<?php

namespace App\Http\Controllers;

use App\Province;
use App\Http\Resources\ProvinceStore;
use App\Http\Resources\ProvinceResource;
use App\Http\Resources\ProvinceCollection;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('provinces.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $province = Province::create([
            'title' => $request->title,
            'status' => $request->status
        ]);

        $province = new ProvinceStore($province);

        return [
            "success" => !is_null($province),
            "data" => $province
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function show(Province $province)
    {
        $province = new ProvinceResource($province);

        return [
            "success" => true,
            "data" => $province
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function edit(Province $province)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Province $province)
    {
        $province['title'] = $request['title'];
        $province['status'] = $request['status'];
        $province->save();

        $province = new ProvinceStore($province);

        return [
            "success" => !is_null($province),
            "data" => $province
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function destroy(Province $province)
    {
        //
    }

    /**
     * Get province list
     */
    public function provincesList()
    {
        $list = Province::select(['id', 'title', 'status'])
            ->paginate(parent::PAGE_SIZE);

        $list = new ProvinceCollection($list);

        return $list;
    }
}
