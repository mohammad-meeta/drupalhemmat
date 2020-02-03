<?php

namespace App\Http\Controllers;

use App\Indicator;
use App\Monitoring;
use App\Http\Resources\IndicatorStore;
use App\Http\Resources\IndicatorResource;
use App\Http\Resources\IndicatorCollection;
use App\Http\Resources\IndicatorMonitoringCollection;
use App\Http\Resources\MonitoringIndicatorCollection;
use Illuminate\Http\Request;

class IndicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('indicators.index');
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
        $indicator = Indicator::create([
            'title' => $request->title,
            'indicator_category_id' => $request->indicatorCategory,
            'status' => $request->status
        ]);

        $indicator->load('indicatorCategory');
        $indicator = new IndicatorStore($indicator);

        return [
            "success" => !is_null($indicator),
            "data" => $indicator
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Indicator  $indicator
     * @return \Illuminate\Http\Response
     */
    public function show(Indicator $indicator)
    {
        $indicator->load(['indicatorCategory']);
        $indicator = new IndicatorResource($indicator);
        $condition = [
            ['status', true],
            ['indicator_id', $indicator->id]
        ];

        $list = Monitoring::select(['id', 'indicator_id', 'province_id', 'amount', 'year', 'status'])
            ->where($condition)
            ->paginate(parent::PAGE_SIZE);

        $list = new MonitoringIndicatorCollection($list);


        return [
            "success" => true,
            "data" => [$indicator,
                    $list]
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Indicator  $indicator
     * @return \Illuminate\Http\Response
     */
    public function edit(Indicator $indicator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Indicator  $indicator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Indicator $indicator)
    {
        $indicator['title'] = $request['title'];
        $indicator['indicator_category_id'] = $request['indicatorCategory'];
        $indicator['status'] = $request['status'];
        $indicator->save();

        $indicator = new IndicatorStore($indicator);

        return [
            "success" => !is_null($indicator),
            "data" => $indicator
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Indicator  $indicator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Indicator $indicator)
    {
        //
    }

    /**
     * Get indicators list
     */
    public function indicatorsList()
    {
        $list = Indicator::select(['id', 'title', 'indicator_category_id', 'status'])
            ->paginate(parent::PAGE_SIZE);

        $list = new IndicatorCollection($list);

        return $list;
    }

    /**
     * show monitoring indicators index page
     */
    public function monitoringIndicators()
    {
        return view('indicators.monitoring-indicators');
    }

    /**
     * Get monitoring indicators list
     */
    public function monitoringIndicatorsList()
    {
        $condition = [
            ['status', true]
        ];

        $indicatorlist = Indicator::with(['indicatorCategory'])
            ->where($condition)
            ->paginate(parent::PAGE_SIZE);

        $indicatorlist = new IndicatorMonitoringCollection($indicatorlist);
        return $indicatorlist;
    }
}
