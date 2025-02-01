<?php

namespace App\Http\Controllers;

use App\Fat;
use DateTime;
use App\Customer;
use App\EveningMilk;
use App\MorningMilk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "स्वागतम";
        $customers = Customer::get();
        $fat = Fat::first();
        return view('pages.home')->with(['title' => $title, 'customers' => count($customers), 'fat' => $fat->fat_rate]);
    }

    public function changeFat()
    {
        $fat = Fat::first();
        $title = "फ्याट";
        return view('pages.changefat')->with(['title' => $title, 'fat' => $fat]);
    }

    public function addcustomer()
    {
        $title = "नयाँ ग्राहक";
        return view('pages.addcustomer')->with(['title' => $title]);
    }

    public function managecustomer()
    {
        $customers = Customer::orderBy('customer_id', 'asc')->get();
        $title = "ग्राहक ब्यबस्थापन";
        return view('pages.managecustomer')->with(['title' => $title, 'customers' => $customers]);
    }

    public function addmrngmilk()
    {
        $title = "बिहानको दुध";
        return view('pages.addmrngmilk')->with(['title' => $title]);
    }
    public function addevemilk()
    {
        $title = "बेलुकाको दुध";
        return view('pages.addevemilk')->with(['title' => $title]);
    }

    public function seemilk()
    {
        date_default_timezone_set('Asia/Kathmandu');
        $now = new DateTime(date("Y-m-d"));

        $mrngmilks = MorningMilk::where('insert_date', $now)->orderBy('customer_id', 'asc')->get();
        $evemilks = EveningMilk::where('insert_date', $now)->orderBy('customer_id', 'asc')->get();
        $title = "आजको दुधको लिस्ट";
        return view('pages.seemilk')->with(['title' => $title, 'mrngmilks' => $mrngmilks, 'evemilks' => $evemilks]);
    }

    public function calculate()
    {
        $title = "दुधको हिसाब";
        return view('pages.calculatemilk')->with(['title' => $title, 'customer' => 'null', 'mrngmilks' => [], 'evemilks' => [], 'advanceAmounts' => []]);
    }

    public function history()
    {
        $title = "पुरानो हिसाब";
        return view('pages.history')->with(['title' => $title, 'histories' => 'null']);
    }

}
