<?php

namespace App\Http\Controllers;

use App\Advance;
use App\Customer;
use App\EveningMilk;
use App\Fat;
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
        $dayMilk    = null;
        $dayFat     = null;
        $nitMilk    = null;
        $nitFat     = null;
        $avgFat     = null;
        $totalMilk  = null;
        $totalFat   = null;
        $totalMoney = null;
        $search     = $request->input('keyword');
        $title      = "ग्राहक:" . $search;
        $startDate = null;
        $endDate = null;

        if ($search != null) {
            $customer = Customer::where('customer_id', $search)
                ->orWhere('name', $search)
                ->orWhere('contact', $search)->first();

            if ($customer == null) {
                return redirect('/calculate-my-money')->with('error', 'डाटा प्राप्त भएन|');
            }


            // Fetch morning milk records
            $mrngmilks = MorningMilk::select('np_date', 'customer_id', 'milk_qt', 'fat_point')
                ->where('customer_id', $customer->customer_id);

            // Fetch evening milk records and join with morning records
            $milkData = EveningMilk::select('np_date', 'customer_id', 'milk_qt', 'fat_point')
                ->where('customer_id', $customer->customer_id)
                ->union($mrngmilks)
                ->orderBy('np_date', 'asc')
                ->orderBy('customer_id', 'asc')
                ->take(15)
                ->get();

            // Grouping by np_date
            $groupedMilkData = $milkData->groupBy('np_date');

            $mrngMilks = MorningMilk::where('customer_id', $customer->customer_id)->orderBy('insert_date', 'asc')->take(15)->get();
            $eveMilks  = EveningMilk::where('customer_id', $customer->customer_id)->orderBy('insert_date', 'asc')->take(15)->get();


            $advanceAmounts = Advance::where('customer_id', $customer->customer_id)->where('settled', 0)->orderBy('insert_date', 'asc')->get();

            $totalAdvanceAmount = Advance::where('customer_id', $customer->customer_id)
                ->where('settled', 0)
                ->sum('amount');

            $fat = Fat::first();

            foreach ($mrngMilks as $mrngMilk) {
                $dayMilk += $mrngMilk->milk_qt;
                $dayFat += $mrngMilk->fat_point;
            }

            foreach ($eveMilks as $index=>$eveMilk) {

                if ($index == 0) {
                    $startDate = $eveMilk->np_date;
                }

                $nitMilk += $eveMilk->milk_qt;
                $nitFat += $eveMilk->fat_point;

                if ($index == count($eveMilks) - 1) {
                    $endDate = $eveMilk->np_date;
                }
            }

            if (count($mrngMilks) > 0) {
                $totalMilk  = $dayMilk + $nitMilk;
                $totalFat   = $dayFat + $nitFat;
                $avgFat     = $totalFat / count($mrngMilks);
                $totalMoney = $totalMilk * $avgFat * ($fat->fat_rate);
            } else if (count($eveMilks) > 0) {
                $totalMilk  = $dayMilk + $nitMilk;
                $totalFat   = $dayFat + $nitFat;
                $avgFat     = $totalFat / count($eveMilks);
                $totalMoney = $totalMilk * $avgFat * ($fat->fat_rate);
            } else {
                $totalMilk  = $dayMilk + $nitMilk;
                $totalFat   = $dayFat + $nitFat;
                $avgFat     = 0;
            }


            return view('pages.calculatemilk')->with([
                'title'      => $title,
                'customer'   => $customer,
                'mrngMilk'   => $dayMilk,
                'mrngFat'    => $dayFat,
                'eveMilk'    => $nitMilk,
                'eveFat'     => $nitFat,
                'totalMilk'  => $totalMilk,
                'totalFat'   => $totalFat,
                'avgFat'     => round($avgFat, 2),
                'totalMoney' => round($totalMoney),
                'fat_rate'   => $fat->fat_rate,
                'totDay'     => count($mrngMilks),
                'mrngmilks'  => $mrngMilks,
                'evemilks'   => $eveMilks,
                'advanceAmounts' => $advanceAmounts,
                'totalAdvanceAmount' => $totalAdvanceAmount,
                'groupedMilkData' => $groupedMilkData,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ]);
        }

        if ($search == null) {
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
