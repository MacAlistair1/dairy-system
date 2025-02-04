<?php

namespace App\Http\Controllers;

use App\EveningMilk;
use App\MorningMilk;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/see-milk')->with('error', 'डाटा प्राप्त भएन|');
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
        $search = $request->input('keyword');

        if ($search != null) {

            // Fetch morning milk records
            $mrngmilks = MorningMilk::select('np_date', 'customer_id', 'milk_qt', 'fat_point')
                ->where('customer_id', $search);

            // Fetch evening milk records and join with morning records
            $milkData = EveningMilk::select('np_date', 'customer_id', 'milk_qt', 'fat_point')
                ->where('customer_id', $search)
                ->union($mrngmilks)
                ->orderBy('np_date', 'asc')
                ->orderBy('customer_id', 'asc')
                ->get();

            // Grouping by np_date
            $groupedMilkData = $milkData->groupBy('np_date');


            return view('pages.seemilk')->with(['title' => 'खोजि गरिएको: ' . $search, 'groupedMilkData' => $groupedMilkData]);
        }

        if ($search == null) {
            return redirect('/see-milk')->with('error', 'डाटा प्राप्त भएन|');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
