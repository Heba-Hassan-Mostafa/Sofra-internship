<?php

namespace App\Http\Controllers\WebController;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records=Client::where(function ($query) use ($request){
            if ($request->has('search')){
                $query->whereHas('district',function ($district) use ($request){
                    $district->where('name','like','%'.$request->search.'%');
                });
                $query->orWhere(function ($query) use ($request){
                    $query->where('name','like','%'.$request->search.'%');
                });
            }
        })->latest()->paginate();
        return view('admin.clients.index',compact('records'));
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
        //
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
        $record= Client::findOrfail($id);
        $record->delete();
        flash()->success("Deleted Successfully ");
        return back();
    }

    public function activate($id)
    {
        $client = Client::findOrFail($id);
        $client->activated = 1;
        $client->save();
        flash()->success('تم التفعيل');
        return back();
    }
    public function deActivate($id)
    {
        $client = Client::findOrFail($id);
        $client->activated = 0;
        $client->save();
        flash()->success('تم الإيقاف');
        return back();
    }
}
