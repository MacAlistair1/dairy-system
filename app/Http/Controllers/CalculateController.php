<?php

namespace App\Http\Controllers;

use App\Fat;
use App\Customer;
use App\EveningMilk;
use App\MorningMilk;
use Illuminate\Http\Request;

class CalculateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/calculate-my-money')->with('error', 'डाटा प्राप्त भएन|');
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
        $dayMilk = null;
        $dayFat = null;
        $nitMilk = null;
        $nitFat = null;
        $avgFat = null;
        $totalMilk = null;
        $totalFat = null;
        $totalMoney = null;
        $search = $request->input('keyword');
        $title = "ग्राहक:".$search;
        
        if ($search != null) {
            $customer = Customer::where('customer_id', $search)
                                    ->orWhere('name', $search)
                                    ->orWhere('contact', $search)->first();

            if ($customer == null) {
                return redirect('/calculate-my-money')->with('error', 'डाटा प्राप्त भएन|');                
            }

            $mrngMilks = MorningMilk::where('customer_id', $customer->customer_id)->orderBy('insert_date', 'asc')->take(15)->get();                        
            $eveMilks = EveningMilk::where('customer_id', $customer->customer_id)->orderBy('insert_date', 'asc')->take(15)->get();    

            //if($mrngMilks == null)

            $fat = Fat::first();              
            
            foreach($mrngMilks as $mrngMilk){
                $dayMilk += $mrngMilk->milk_qt;
                $dayFat += $mrngMilk->fat_point;
            }

            foreach($eveMilks as $eveMilk){
                $nitMilk += $eveMilk->milk_qt;
                $nitFat += $eveMilk->fat_point;
            }

            if(count($mrngMilks) == 0){
                return redirect('/calculate-my-money')->with('error', 'हिसाब उपलब्ध छैन|');
            }

            $totalMilk = $dayMilk + $nitMilk;
            $totalFat = $dayFat + $nitFat;
            $avgFat = $totalFat/count($mrngMilks);
            $totalMoney = $totalMilk * $avgFat*($fat->fat_rate);




            return view('pages.calculatemilk')->with(['title' => $title, 
                                                        'customer' => $customer, 
                                                        'mrngMilk' => $dayMilk, 
                                                        'mrngFat' => $dayFat,
                                                        'eveMilk' => $nitMilk,
                                                        'eveFat' => $nitFat,
                                                        'totalMilk' => $totalMilk,
                                                        'totalFat' => $totalFat,
                                                        'avgFat' => round($avgFat, 2),
                                                        'totalMoney' => round($totalMoney),
                                                        'fat_rate' => $fat->fat_rate,
                                                        'totDay' => count($mrngMilks)
                                                        ]);

        }

        if($search == null){
            return redirect('/calculate-my-money')->with('error', 'डाटा प्राप्त भएन|');
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
