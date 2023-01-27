<?php

namespace App\Http\Controllers;

use App\peoplesoft;
use Illuminate\Http\Request;
use DB;

class PeoplesoftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dato = DB::connection('peoplesoft')->table('user')->get();
        dump($dato);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\peoplesoft  $peoplesoft
     * @return \Illuminate\Http\Response
     */
    public function show(peoplesoft $peoplesoft)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\peoplesoft  $peoplesoft
     * @return \Illuminate\Http\Response
     */
    public function edit(peoplesoft $peoplesoft)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\peoplesoft  $peoplesoft
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, peoplesoft $peoplesoft)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\peoplesoft  $peoplesoft
     * @return \Illuminate\Http\Response
     */
    public function destroy(peoplesoft $peoplesoft)
    {
        //
    }
}
