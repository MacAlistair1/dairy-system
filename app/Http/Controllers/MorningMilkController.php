<?php

namespace App\Http\Controllers;

use DateTime;
use App\Customer;
use App\EveningMilk;
use App\MorningMilk;
use Illuminate\Http\Request;

class MorningMilkController extends Controller
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
        date_default_timezone_set('Asia/Karachi');
        $now = new DateTime(date("Y-m-d"));
       
        $this->validate($request, [
            'customer_id' => 'required',
            'milk_qt' => 'required',
            'fat_point' => 'required'
        ]);

        $customer = Customer::where('customer_id', $request->customer_id)->first();

        if ($customer == null) {
            return redirect('/add-morning-milk')->with('error', 'यो नम्बरको कोहिपनि ग्रहक छैन|');            
        }

        $oldMrngMilk = MorningMilk::where(['insert_date' => $now, 'customer_id' => $request->customer_id])->first();

        if ($oldMrngMilk != null) {
            $oldMrngMilk->customer_id = $request->customer_id;
            $oldMrngMilk->milk_qt = $request->milk_qt;
            $oldMrngMilk->fat_point = $request->fat_point;
            $oldMrngMilk->insert_date = $now;
            $oldMrngMilk->save();

            return redirect('/add-morning-milk')->with('success', 'दुध थपियो|');
        }


        $morningMilk = new MorningMilk;
        $morningMilk->customer_id = $request->customer_id;
        $morningMilk->milk_qt = $request->milk_qt;
        $morningMilk->fat_point = $request->fat_point;
        $morningMilk->insert_date = $now;
        $morningMilk->save();

        $eveningMilk = new EveningMilk;
        $eveningMilk->customer_id = $request->customer_id;
        $eveningMilk->milk_qt = "0";
        $eveningMilk->fat_point = "0";
        $eveningMilk->insert_date = $now;
        $eveningMilk->save();

        return redirect('/add-morning-milk')->with('success', 'दुध थपियो|');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MorningMilk  $morningMilk
     * @return \Illuminate\Http\Response
     */
    public function show(MorningMilk $morningMilk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MorningMilk  $morningMilk
     * @return \Illuminate\Http\Response
     */
    public function edit(MorningMilk $morningMilk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MorningMilk  $morningMilk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MorningMilk $morningMilk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MorningMilk  $morningMilk
     * @return \Illuminate\Http\Response
     */
    public function destroy(MorningMilk $morningMilk)
    {
        //
    }
}
