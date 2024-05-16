<?php

namespace App\Http\Controllers;

use App\Models\DataMagang;
use Illuminate\Http\Request;

class DataMagangAdminSideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view('pages.contents.admin.data-magang.index', ["dm" => DataMagang::all() ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DataMagang $dataMagang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataMagang $dataMagang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataMagang $dataMagang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataMagang $dataMagang)
    {
        //
    }
}
