<?php

namespace App\Http\Controllers\WebController;

use App\Models\Meal;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $meals=Meal::where(function ($query) use ($request){
            if($request->has('search')){
                $query->whereHas('restaurant',function ($restaurant) use($request){
                    $restaurant->where('name','like','%'.$request->search.'%');
                });
                $query->orWhere(function ($query) use($request){
                    $query->where('name','like','%'.$request->search.'%');
                });
            }
        })->latest()->paginate();


        return view('admin.meals.index',compact('meals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurants=Restaurant::all();
        return view('admin.meals.create',compact('restaurants'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $meal = $request->validate([
//            'restaurant_id'=>'required',
//            'name'=>'required|unique:meals',
//            'price'=>'required',
//            'preparation_time'=>'required',
//            'discount_price' => 'required',
//            'short_description' => 'required',
//            'image' => 'sometimes|file|image|max:5000'
//        ]);
//        $meal= Meal::create($meal);
//
//        $this ->storeImage($meal);

        $data = $request->all();

        $meal = new Meal();

        $meal->name = $data['name'];

        $meal->price = $data['price'];
        $meal->discount_price = $data['discount_price'];
        $meal->preparation_time = $data['preparation_time'];
        $meal->short_description = $data['short_description'];

        $meal->restaurant_id = $data['restaurant_id'];

        //Upload Image
        if ($request->hasFile('image')){

            $image_tmp  = Input::file('image');

            if ($image_tmp->isValid()){

                $extension = $image_tmp->getClientOriginalExtension();

                $filename = rand(111,99999).'.'.$extension;

                $image_path = 'image/'.$filename;

                //Resize Image


                \Intervention\Image\Facades\Image::make($image_tmp)->resize(350,350)->save($image_path);

                //store Image

                $meal->image = $filename;


            }

        }

        $meal->save();

        flash()->success('Successfully Added');
        return redirect('admin/meal');
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
        $model=Meal::findOrfail($id);
        return view('admin.meals.edit',compact('model'));
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
        $record=Meal::findOrfail($id);
        $record->update($request->all());
        flash()->success("Edited successfully");
        return redirect('admin/meal');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record=Meal::findOrfail($id);
        $record->delete();
        flash()->success("Deleted successfully ");
        return back();
    }


}
