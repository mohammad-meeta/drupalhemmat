<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Resources\DepartmentStore;
use App\Http\Resources\DepartmentResource;
use App\Http\Resources\DepartmentCollection;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('departments.index');
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
        $department = Department::create([
            'title' => $request->title,
            'status' => $request->status
        ]);

        $department = new DepartmentStore($department);

        return [
            "success" => !is_null($department),
            "data" => $department
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('departments.show', [ "id" => $id ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $department['title'] = $request['title'];
        $department['status'] = $request['status'];
        $department->save();

        $department = new DepartmentStore($department);

        return [
            "success" => !is_null($department),
            "data" => $department
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }

    /**
     * Get department list
     */
    public function departmentsList()
    {
        $list = Department::all();

        return $list;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function departmentsDetail($id)
    {
        $department = \App\Department::find($id);

        return [
            "success" => true,
            "data" => $department
        ];
    }
}
