<?php

namespace App\Http\Controllers\WebController;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records=Role::paginate(10);
        return view('admin.roles.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule=[
            'name'=>'required|unique:roles,name',
            'display_name'=>'required',
            'permissions_list'=>'required|array',

        ];
        $messages=[
            'name.required'=>'Name Is Required',
            'display_name.required'=>'display name is required  ',
            'permissions_list.required'=>'permission is required',
        ];
        $this->validate($request,$rule,$messages);
        $record=Role::create($request->all());
        $record->permissions()->attach($request->input('permissions_list'));

        flash()->success("Successfully Added");

        return redirect('admin/role');

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
        $model=Role::findOrfail($id);
        return view('admin.roles.edit',compact('model'));
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


        $rule=[
            'name'=>'required|unique:roles,name,'.$id,
            'display_name'=>'required',
            'permissions_list'=>'required|array',

        ];
        $messages=[
            'name.required'=>'Name Is Required ',
            'display_name.required'=>'display nameis required',
            'permissions_list.required'=>'permissions is required',
        ];
        $this->validate($request,$rule,$messages);

        $record=Role::findOrfail($id);
        $record->update($request->all());
        $record->permissions()->sync($request->input('permissions_list'));

        flash()->success("Updated Successfully ");
        return redirect('admin/role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record=Role::findOrfail($id);
        $record->delete();
        flash()->success("Successfully Deleted");
        return back();
    }
}
