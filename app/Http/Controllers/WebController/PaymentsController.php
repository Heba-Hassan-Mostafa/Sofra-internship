<?php

namespace App\Http\Controllers\WebController;

use App\Models\Payment;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records=Payment::all();
        return view('admin.payments.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurants = Restaurant::all();
        return view ('admin.payments.create',compact('restaurants'));    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule= [
            'restaurant_id'=>'required',
            'paid'=>'required'
        ];
        $message=[
            'restaurant_id.required'=>'The Restaurant Is Required',
            'paid.required'=>'The paid Is Required',

        ];


        $this->validate($request,$rule,$message);


        $payment = Payment::create($request->all());

        flash()->success("Successfully Added");

        return redirect('admin/payments');
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
        $model=Payment::findOrfail($id);
        $restaurants = Restaurant::all();
        return view('admin.payments.edit',compact('model','restaurants'));
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
        $rule= [
            'restaurant_id'=>'required',
            'paid'=>'required'
        ];
        $message=[
            'restaurant_id.required'=>'The Restaurant Is Required',
            'paid.required'=>'The paid Is Required',

        ];


        $this->validate($request,$rule,$message);
        $record=Payment::findOrfail($id);
        $record->update($request->all());
        flash()->success("Edited successfully");
        return redirect('admin/payments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record=Payment::findOrfail($id);
        $record->delete();
        flash()->success("Deleted successfully ");
        return back();
    }
}
