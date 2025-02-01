<?php

namespace App\Http\Controllers;

use App\Advance;
use DateTime;
use App\Customer;
use App\EveningMilk;
use App\MorningMilk;
use Illuminate\Http\Request;

class AdvanceAmountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "अग्रिम रकम";
        return view('pages.advance')->with(['title' => $title]);
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
        date_default_timezone_set('Asia/Kathmandu');
        $now = new DateTime(date("Y-m-d"));

        $this->validate($request, [
            'customer_id' => 'required',
            'amount' => 'required',
            'remarks' => 'required'
        ]);

        $customer = Customer::where('customer_id', $request->customer_id)->first();

        if ($customer == null) {
            return redirect('/advance-amount')->with('error', 'यो नम्बरको कोहिपनि ग्राहक छैन|');
        }

        $advance = new Advance;
        $advance->customer_id = $request->customer_id;
        $advance->amount = $request->amount;
        $advance->remarks = $request->remarks;
        $advance->insert_date = $now;
        $advance->save();

        return redirect('/advance-amount')->with('success', 'ग्राहकलाई दिएको अग्रिम रकम/सामान थपियो|');

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
