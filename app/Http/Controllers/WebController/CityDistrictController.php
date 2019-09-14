<?php

namespace App\Http\Controllers\WebController;

use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpParser\Node\Expr\New_;

class CityDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(City $city)
    {
        $districts=$city->districts()->paginate();
        return view('admin.districts.index',compact('districts','city'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(City $city)
    {
        return view('admin.districts.create',compact('city'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $rule=['name'=>'required|unique:districts'];
        $message=['name.required'=>'Name Is Required'];

        $this->validate($request,$rule,$message);
        $record=new District();
        $record->name=$request->input('name');
        $record->city_id=$id;
        $record->save();
        flash()->success('Successfully Added');
        return redirect()->route('city.district.index',compact('id'));


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
    public function edit(City $city,$id)
    {
        $model=$city->districts()->findOrFail($id);
        return view('admin.district.edit',compact('model','city','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(City $city,Request $request, $id)
    {
        $rule=['name'=>'required|unique:districts'];
        $message=['name.required'=>'Name Is Required'];

        $this->validate($request,$rule,$message);

        $model=$city->districts()->findOrFail($id);
        $model->update($request->all());
        flash()->success('Edited successfully');
        return redirect(route('city.district.index',compact('city','id')));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city,$id)
    {
        $model=$city->districts()->findOrFail($id);
        $model->delete();
        flash()->success("Deleted Successfully ");
        return back();

    }
}
