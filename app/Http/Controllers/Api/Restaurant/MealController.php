<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Models\Meal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MealController extends Controller
{

    //List Of Meals

    public function listMeal(Request $request)
    {
        $meals = $request->user()->meals()->paginate();

        return apiResponse(1, 'success', $meals);

    }

    // Create order
    public function createMeal(Request $request)
    {
        $validation = validator()->make($request->all(), [

            'name' => 'required',
            'image' => 'required|image|max:2048',
            'short_description' => 'required',
            'price' => 'required',
            'discount_price' => 'required',
            'preparation_time' => 'required',
            'restaurant_id' => 'required',

        ]);

        if ($validation->fails()) {
            return apiResponse(0, $validation->errors()->first(), $validation->errors());
        }

        $meal = Meal::create($request->all());
        if ($request->hasFile('image')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/meals/';    // upload path
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();    // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension;    // renaming image
            $image->move($destinationPath, $name);    // uploading file to given path
            $meal->update(['image' => 'uploads/meals/' . $name]);
        }

        return apiResponse(1, 'Meal Added Successfully', $meal);

    }

    //Update Meal

    public function updateMeal(Request $request)
    {
        $validation = validator()->make($request->all(), [

            'name' => 'unique:meals,name,' . $request->user()->id,
            'image' => 'unique:meals,image,' . $request->user()->id,
            'short_description' => 'unique:meals,short_description,' . $request->user()->id,
            'price' => 'unique:meals,price,' . $request->user()->id,
            'discount_price' => 'unique:meals,discount_price,' . $request->user()->id,


        ]);

        if ($validation->fails()) {

            return apiResponse(0, $validation->errors()->first(), $validation->errors());

        }

        //Update Meal
        $meal =$request->user()->meals()->find($request->meal_id);
        if (!$meal)
        {
            return apiResponse(0,'there is no meal with this information');
        }
        $meal->update($request->all());
        if ($request->hasFile('image')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/meals/';    // upload path
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();    // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension;    // renaming image
            $image->move($destinationPath, $name);    // uploading file to given path
            $meal->update(['image' => 'uploads/items/' . $name]);
        }
        return apiResponse(1, 'Modified Successfully', [
            'api_token' => $meal->api_token,
            'meal' => $meal
        ]);
    }

    public function deleteMeal(Request $request)
    {
        $meal = $request->user()->meals()->find($request->meal_id);
        if (!$meal) {
            return apiResponse(0, 'there is no meal with this information');
        }
        $meal->delete($request->all());
           return apiResponse(1, 'Successfully deleted');

    }
}