<?php

namespace App\Http\Controllers;

use DateTime;
use App\Customer;
use App\EveningMilk;
use App\MorningMilk;
use Illuminate\Http\Request;

class EveningMilkController extends Controller
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
            return redirect('/add-evening-milk')->with('error', 'यो नम्बरको कोहिपनि ग्रहक छैन|');            
        }

        $oldEveMilk = EveningMilk::where(['insert_date' => $now, 'customer_id' => $request->customer_id])->first();
       
        if ($oldEveMilk != null) {
            $oldEveMilk->customer_id = $request->customer_id;
            $oldEveMilk->milk_qt = $request->milk_qt;
            $oldEveMilk->fat_point = $request->fat_point;
            $oldEveMilk->insert_date = $now;
            $oldEveMilk->save();

            return redirect('/add-morning-milk')->with('success', 'दुध थपियो|');
        }


        $eveningMilk = new EveningMilk;
        $eveningMilk->customer_id = $request->customer_id;
        $eveningMilk->milk_qt = $request->milk_qt;
        $eveningMilk->fat_point = $request->fat_point;
        $eveningMilk->insert_date = $now;
        $eveningMilk->save();

        $morningMilk = new MorningMilk;
        $morningMilk->customer_id = $request->customer_id;
        $morningMilk->milk_qt = "0";
        $morningMilk->fat_point = "0";
        $morningMilk->insert_date = $now;
        $morningMilk->save();

        return redirect('/add-evening-milk')->with('success', 'दुध थपियो|');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EveningMilk  $eveningMilk
     * @return \Illuminate\Http\Response
     */
    public function show(EveningMilk $eveningMilk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EveningMilk  $eveningMilk
     * @return \Illuminate\Http\Response
     */
    public function edit(EveningMilk $eveningMilk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EveningMilk  $eveningMilk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EveningMilk $eveningMilk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EveningMilk  $eveningMilk
     * @return \Illuminate\Http\Response
     */
    public function destroy(EveningMilk $eveningMilk)
    {
        //
    }
}
