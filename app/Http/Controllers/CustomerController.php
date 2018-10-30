<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use DB;

class CustomerController extends Controller
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
            'customer_id' => 'required|max:3|unique:customers',
            'name' => 'required',
            'contact' => 'required|max:15|min:10',
            
        ]);
        
        $customer = new Customer;
        $customer->customer_id = $request->customer_id;
        $customer->name = $request->name;
        $customer->contact = $request->contact;
        $customer->save();

        return redirect('/add-customer')->with('success', 'नयाँ ग्राहक थपियो|');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $customer = Customer::where('customer_id', $id)->first();

        $title = "ग्राहकको सुचना परिवर्तन";
        return view('pages.editcustomer')->with(['title' => $title, 'customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::where('customer_id', $id)->first();

        $this->validate($request, [
            'customer_id' => 'required|max:3',
            'name' => 'required',
            'contact' => 'required|max:15|min:10',
            
        ]);

        DB::table('customers')
                    ->where('customer_id', $id)
                    ->update(['customer_id' => $request->customer_id, 'name' => $request->name, 'contact' => $request->contact]);


        return redirect('/manage-customer')->with('success', 'ग्राहकको सुचना परिवर्तन गरियो|');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::table('customers')
                    ->where(['customer_id' => $id])
                    ->delete();

        return redirect('/manage-customer')->with('success', 'ग्राहक हटाइयो|');
    }
}
