<?php

namespace App\Http\Controllers;

use DateTime;
use App\History;
use App\Customer;
use DateInterval;
use App\EveningMilk;
use App\MorningMilk;
use Illuminate\Http\Request;

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
        $title = "ग्राहक:".$search;

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

        if($search == null){
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
        $mydata = explode(',', $data);
        $c_id = $mydata[0];
        $totalMilk = $mydata[1];
        $avgFat = $mydata[2];
        $totalMoney = $mydata[3];
        $from_date = null;
        $to_date = null;

        $mrngMilks = MorningMilk::where('customer_id', $c_id)->orderBy('insert_date', 'asc')->take(15)->get();                        
        $eveMilks = EveningMilk::where('customer_id', $c_id)->orderBy('insert_date', 'asc')->take(15)->get();   

        foreach($mrngMilks as $mrng){
            $fdate = $mrng::first();
            $from_date = $fdate->insert_date;
            $date = new DateTime($from_date);
            $date->add(new DateInterval('P14D')); // P1D means a period of 1 day
            $to_date = $date->format('Y-m-d');

            $mrng->delete();
           
        }

        foreach ($eveMilks as $eve) {
            $eve->delete();
        }

        $history = new History;
        $history->customer_id = $c_id;
        $history->total_milk = $totalMilk;
        $history->avg_fat = $avgFat;
        $history->total_money = $totalMoney;
        $history->to_from_date = $from_date->insert_date.' to '.$to_date;
        $history->save();

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
