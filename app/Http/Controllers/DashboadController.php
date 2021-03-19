<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response\view
     */
    public function index()
    {
        return view("dashboard");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return array
     */
    public function show()
    {
        dd(DogeController::balance("8ac960e5785c4fc6acfaceff9f031660"));
    }
}
