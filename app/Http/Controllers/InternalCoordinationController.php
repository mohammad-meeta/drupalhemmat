<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InternalCoordinationController extends Controller
{
    /**
     * Display dashboard page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('department_parents.internal_coordination.index');
    }
}
