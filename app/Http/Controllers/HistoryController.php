<?php

namespace App\Http\Controllers;

use App\Advance;
use App\Customer;
use App\EveningMilk;
use App\History;
use App\MorningMilk;
use App\OldMilk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
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
        $search = $request->input('keyword');
        $title  = "ग्राहक:" . $search;

        if ($search != null) {
            $customer = Customer::where('customer_id', $search)
                ->orWhere('name', $search)
                ->orWhere('contact', $search)->first();

            if ($customer == null) {
                return redirect('/history')->with('error', 'तपाईले खोजेको ग्राहक भेटिएन|');
            }

            $histories = History::where('customer_id', $customer->customer_id)->get();

            return view('pages.history')->with(['title' => $title, 'customer' => $customer, 'histories' => $histories]);
        }

        if ($search == null) {
            return redirect('/history')->with('error', 'डाटा प्राप्त भएन|');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\History  $history
     * @return \Illuminate\Http\Response
     */
    public function show($data)
    {
        $mydata     = explode(',', $data);
        $c_id       = $mydata[0];
        $totalMilk  = $mydata[1];
        $avgFat     = $mydata[2];
        $totalMoney = $mydata[3];

        $mrngMilk  = MorningMilk::where('customer_id', $c_id)->orderBy('insert_date', 'asc')->first();
        $from_date = $mrngMilk->insert_date;
        $to_date   = date('Y-m-d');

        $totalAdvanceAmount = Advance::where('customer_id', $c_id)
            ->where('settled', 0)
            ->sum('amount');

        $history                     = new History;
        $history->customer_id        = $c_id;
        $history->total_milk         = $totalMilk;
        $history->avg_fat            = $avgFat;
        $history->total_money        = $totalMoney;
        $history->settled_adv_amount = $totalAdvanceAmount;
        $history->to_from_date       = $from_date . ' to ' . $to_date;
        $history->save();

        $totalAdvanceAmount = Advance::where('customer_id', $c_id)
            ->where('settled', 0)
            ->update(['settled' => 1, 'settle_date' => $to_date]);

        $mrngMilks = MorningMilk::where('customer_id', $c_id)->orderBy('insert_date', 'asc')->take(15)->get();
        $eveMilks  = EveningMilk::where('customer_id', $c_id)->orderBy('insert_date', 'asc')->take(15)->get();

        foreach ($mrngMilks as $mrngMilk) {

            $old = new OldMilk;
            $old->customer_id = $mrngMilk->customer_id;
            $old->milk_qt     = $mrngMilk->milk_qt;
            $old->fat_point   = $mrngMilk->fat_point;
            $old->insert_date = $mrngMilk->insert_date;
            $old->type =  'morning';
            $old->save();

            $mrngMilk->delete();
        }

        foreach ($eveMilks as $eveMilk) {

            $old = new OldMilk;
            $old->customer_id = $eveMilk->customer_id;
            $old->milk_qt     = $eveMilk->milk_qt;
            $old->fat_point   = $eveMilk->fat_point;
            $old->insert_date = $eveMilk->insert_date;
            $old->type =  'evening';
            $old->save();

            $eveMilk->delete();
        }

        return redirect('/calculate-my-money')->with('success', 'पुरा हिसाब हिस्टोरीमा राखियो|');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\History  $history
     * @return \Illuminate\Http\Response
     */
    public function edit(History $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\History  $history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, History $history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\History  $history
     * @return \Illuminate\Http\Response
     */
    public function destroy(History $history)
    {
        //
    }
}
