<?php

namespace App\Http\Controllers\WebController;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records=City::paginate();
        return view('admin.cities.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule=['name'=>'required|unique:cities'];

        $message=['name.required'=>'The Name Is Required'];
        $this->validate($request,$rule,$message);

        $record=City::create($request->all());

        flash()->success("Successfully Added");


        return redirect('admin/city');



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
        $model=City::findOrfail($id);
        return view('admin.cities.edit',compact('model'));
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
        $rule=['name'=>'required|unique:cities'];

        $message=['name.required'=>'The Name Is Required'];
        $this->validate($request,$rule,$message);

        $record=City::findOrfail($id);
        $record->update($request->all());
        flash()->success("Edited successfully");
        return redirect('admin/city');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record=City::findOrfail($id);
        $record->delete();
        flash()->success("Deleted successfully ");
        return back();
    }
}
