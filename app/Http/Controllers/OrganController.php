<?php

namespace App\Http\Controllers;

use App\Organ;
use App\City;
use Illuminate\Http\Request;

class OrganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organs = Organ::with('city')->get();
        return view('organs.index', compact('organs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::pluck('title', 'id');
        return view('organs.create', compact('cities', $cities));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $organ = Organ::create([
            'title' => $request->title,
            'city_id' => $request->city
        ]);

        return redirect()->route('organ.index')->with('success', 'دستگاه اجرایی با موفقیت ذخیره شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Organ  $organ
     * @return \Illuminate\Http\Response
     */
    public function show(Organ $organ)
    {
        return view('organs.show', compact('organ'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organ  $organ
     * @return \Illuminate\Http\Response
     */
    public function edit(Organ $organ)
    {
        $cities = City::pluck('title', 'id');
        return view('organs.edit', compact('organ', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organ  $organ
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organ $organ)
    {
        $organ['title'] = $request['title'];
        $organ['city_id'] = $request['city'];
        $organ->save();
        return redirect('/organ/' . $organ->id)->with('success', 'دستگاه اجرایی با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organ  $organ
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organ $organ)
    {
        //
    }
}
