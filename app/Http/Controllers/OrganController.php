<?php

namespace App\Http\Controllers;

use App\Organ;
use App\City;
use App\Http\Resources\OrganizationStore;
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
        return view('organs.index');
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

        $organ->load('city');
        $organ = new OrganizationStore($organ);

        return [
            "success" => ! is_null($organ),
            "data" => $organ
        ];

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

        $organ->load('city');
        $organ = new OrganizationStore($organ);

        return [
            "success" => !is_null($organ),
            "data" => $organ
        ];
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


    /**
     * Get organizations list
     */
    public function organsList()
    {
        $list = Organ::with('city')
            ->paginate(parent::PAGE_SIZE);

        return $list;
    }
}
