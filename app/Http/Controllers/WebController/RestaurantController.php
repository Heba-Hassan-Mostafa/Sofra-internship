<?php

namespace App\Http\Controllers\WebController;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $restaurants = Restaurant::where(function ($query) use ($request) {
            if ($request->has('search')) {
                $query->whereHas('district', function ($district) use ($request) {
                    $district->where('name', 'like', '%' . $request->search . '%');
                });
                $query->orWhere(function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('status','like','%'.$request->search.'%');
                });
            }
        })->paginate();
        return view('admin.restaurants.index', compact('restaurants'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Restaurant $model)
    {
//        return view('admin.restaurants.create',compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $this->validate($request, [
//            'name' => 'required',
//            'district' => 'required',
//            'image' => 'required'
//        ]);
//        $restaurant = Restaurant::create($request->all());
//        if ($request->hasFile('image')) {
//            $path = public_path();
//            $destinationPath = $path . '/uploads/meals/';    // upload path
//            $image = $request->file('image');
//            $extension = $image->getClientOriginalExtension();    // getting image extension
//            $name = time() . '' . rand(11111, 99999) . '.' . $extension;    // renaming image
//            $image->move($destinationPath, $name);    // uploading file to given path
//            $restaurant->photos()->create(['url' => 'uploads/restaurants/' . $name]);
//        }
//        if ($request->has('district')) {
//            $restaurant->districts()->attach($request->district);
//        }
//        if ($request->has('categories')) {
//            $restaurant->categories()->sync($request->categories);
//        }
//
//        flash()->success('Added Successfully');
//        return redirect('admin/restaurant');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Restaurant::findOrfail($id);
        $record->delete();
        flash()->success("Deleted Successfully ");
        return back();
    }

    public function activate($id)
    {
        $client = Restaurant::findOrFail($id);
        $client->activated = 1;
        $client->save();
        flash()->success('تم التفعيل');
        return back();
    }
    public function deActivate($id)
    {
        $client = Restaurant::findOrFail($id);
        $client->activated = 0;
        $client->save();
        flash()->success('تم الإيقاف');
        return back();
    }
}