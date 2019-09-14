<?php

namespace App\Http\Controllers\WebController;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::paginate(10);
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required|confirmed',
            'roles_list'=>'required'
        ]);

        $request->merge(['password'=>bcrypt($request->password)]);
        $user=User::create($request->except('roles_list'));
        $user->roles()->attach($request->input('roles_list'));
        flash()->success('Added User Successfully');
        return redirect('admin/user');
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
        $model=User::findOrfail($id);
        return view('admin.users.edit',compact('model'));
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
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required|confirmed',
            'roles_list'=>'required'
        ]);
        $user=User::findOrfail($id);
        $user->roles()->sync((array)$request->input('roles_list'));
        $request->merge(['password'=>bcrypt($request->password)]);
        $update=$user->update($request->all());
        flash()->success('Updated Successfully');
        return redirect('admin/user');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::findOrfail($id);
        $user->delete();
        flash()->success("Deleted Successfully ");
        return back();
    }

    public function changePassword()
    {
        return view('admin.users.reset-password');

    }

    public function changePasswordSave(Request $request)
    {
        $rule=[
            'old_password'=>'required',
            'password'=>'required|confirmed'
        ];
        $message=[
            'old_password.required'=>'old password is required',
            'password.required'=>'New password is required'
        ];
        $this->validate($request,$rule,$message);
        $user=Auth::user();
        if (Hash::check($request->input('old_password'),$user->password))
        {
            $user->password=bcrypt($request->input('password'));
            $user->save();
            flash()->success('Password updated');
            return view('admin.users.reset-password');
        }
        else{
            flash()->error(' Password is not correct');
            return back();
        }


    }
}
