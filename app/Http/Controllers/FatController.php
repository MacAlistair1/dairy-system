<?php

namespace App\Http\Controllers;

use App\Fat;
use Illuminate\Http\Request;

class FatController extends Controller
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
        $this->validate($request, [
            'fat_rate' => 'required|numeric'
        ]);

        $fat = Fat::first();
        $fat->fat_rate = $request->fat_rate;
        $fat->save();

        return redirect('/change-fat')->with('success', 'फ्याटको मुल्य परिवर्तन सफल भयो|');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fat  $fat
     * @return \Illuminate\Http\Response
     */
    public function show(Fat $fat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fat  $fat
     * @return \Illuminate\Http\Response
     */
    public function edit(Fat $fat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fat  $fat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fat  $fat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fat $fat)
    {
        //
    }
}
