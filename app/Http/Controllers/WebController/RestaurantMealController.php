<?php

namespace App\Http\Controllers\WebController;

use App\Models\Meal;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class RestaurantMealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Restaurant $restaurant)
    {
        $meals=$restaurant->meals()->paginate();
        return view('admin.meals.index',compact('meals','restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Restaurant $restaurant)
    {
        return view('admin.meals.create',compact('restaurant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $rule=[
            'name'=>'required|unique:meals',
            'image'=>'required',
            'price'=>'required',
            'preparation_time'=>'required',
            'discount_price' => 'required',

        ];
        $message=[
            'name.required'=>'Name Is Required',
            'image.required'=>'Image Is Required',
            'price.required'=>'Price Is Required',
            'preparation_time.required'=>'preparation-time Is Required',
            'discount_price.required'=>'Discount Price Is Required'

        ];
        $this->validate($request,$rule,$message);

        $meal=new Meal();
        $meal->name=$request->input('name');
        $meal->price=$request->input('price');
        $meal->discount_price=$request->input('discount_price');
        $meal->preparation_time=$request->input('preparation_time');
        $meal->restaurant_id=$id;

//        if ($request->hasFile('image')) {
//            $path = public_path();
//            $destinationPath = $path . '/uploads/meals/';    // upload path
//            $image = $request->file('image');
//            $extension = $image->getClientOriginalExtension();    // getting image extension
//            $name = time() . '' . rand(11111, 99999) . '.' . $extension;    // renaming image
//            $image->move($destinationPath, $name);    // uploading file to given path
//            $meal->image =  'uploads/meals/'.$name;
//            $meal->save();
//        }

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

//        $meal->save();

         dd($meal);
//        flash()->success('Successfully Added');
//        return redirect()->route('restaurant.meal.index',compact('id'));
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
    public function destroy(Restaurant $restaurant,$id)
    {
        $model=$restaurant->meals()->findOrFail($id);
        $model->delete();
        flash()->success("Deleted Successfully ");
        return back();

    }
}
