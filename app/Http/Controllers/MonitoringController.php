<?php

namespace App\Http\Controllers;

use App\Monitoring;
use Auth;
use App\Http\Resources\MonitoringStore;
use App\Http\Resources\MonitoringResource;
use App\Http\Resources\MonitoringCollection;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('monitorings.index');
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
        $monitoring = Monitoring::create([
            'indicator_id' => $request->indicator,
            'province_id' => $request->province,
            'year' => $request->year,
            'amount' => $request->amount,
            'user_id' => Auth::user()->id,
            'status' => $request->status
        ]);

        $monitoring->load(['indicator', 'province']);
        $monitoring = new MonitoringStore($monitoring);

        return [
            "success" => !is_null($monitoring),
            "data" => $monitoring
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Monitoring  $monitoring
     * @return \Illuminate\Http\Response
     */
    public function show(Monitoring $monitoring)
    {
        $monitoring->load(['indicator', 'province']);
        $monitoring = new MonitoringResource($monitoring);

        return [
            "success" => true,
            "data" => $monitoring
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Monitoring  $monitoring
     * @return \Illuminate\Http\Response
     */
    public function edit(Monitoring $monitoring)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Monitoring  $monitoring
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Monitoring $monitoring)
    {
        $monitoring['indicator_id'] = $request['indicator'];
        $monitoring['province_id'] = $request['province'];
        $monitoring['amount'] = $request['amount'];
        $monitoring['year'] = $request['year'];
        $monitoring['status'] = $request['status'];
        $monitoring->save();

        $monitoring = new MonitoringStore($monitoring);

        return [
            "success" => !is_null($monitoring),
            "data" => $monitoring
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Monitoring  $monitoring
     * @return \Illuminate\Http\Response
     */
    public function destroy(Monitoring $monitoring)
    {
        //
    }

    /**
     * Get monitorings list
     */
    public function monitoringsList()
    {
        $list = Monitoring::select(['id', 'indicator_id', 'province_id', 'amount', 'year', 'status'])
            ->paginate(parent::PAGE_SIZE);

        $list = new MonitoringCollection($list);

        return $list;
    }
}
