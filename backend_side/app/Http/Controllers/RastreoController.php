<?php

namespace App\Http\Controllers;

use App\Models\rastreo;
use Illuminate\Http\Request;

class RastreoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json('Si entra', 201);
    }

}
