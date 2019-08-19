<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\District;
use App\Models\Meal;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    //List Of Cities

    public function cities(){
        $city=City::all();
        return apiResponse(1,'success',$city);

    }

    //List Of Districts

    public function districts(Request $request){
        $district=District::where(function ($query) use ($request){
            if($request->has('city_id')){
                $query->where('city_id',$request->city_id);
            }
        })->get();
        return apiResponse(1,'success',$district);

    }



    //List Of Restaurant

    public function restaurants(Request $request){
        $restaurant=Restaurant::where(function ($query) use($request){
            if($request->has('district_id')){
                $query->where('district_id',$request->district_id);
            }
            if ($request->has('keyword')){
                $query->where('name','like','%'.$request->keyword.'%');
            }

        })->latest()->paginate();
        return apiResponse(1,'success',$restaurant);
    }

   // List Of Meals Of Restaurants
    public function mealRestaurant(Request $request)
    {
        $meal=Meal::where(function ($query) use($request){
            if($request->has('restaurant_id')){
                $query->where('restaurant_id',$request->restaurant_id);
            }
        })->latest()->paginate();

        return apiResponse(1,'success',$meal);
    }

    // list Of Restaurant Information

    public function restaurantInfo(Request $request)
    {
        $info=Restaurant::find($request->id);

        return apiResponse(1,'success',$info);
    }


    // List Of Offers
    public function listOffer(Request $request)
    {
        $offer=Offer::where(function ($query) use($request){
            if($request->has('restaurant_id')){

                $query->where('restaurant_id',$request->restaurant_id);
            }
        })->latest()->paginate();

        return apiResponse(1,'success',$offer);
    }




    //Settings Function
    public function settings(){

        return apiResponse(1,'success',settings());

    }



    public function categories(Request $request )
    {
        $categories = Category::where(function ($query) use($request){
            if($request->has('restaurant_id')){
                $query->where('restaurant_id',$request->restaurant_id);
            }
        })->latest()->paginate();
        return apiResponse('1','success',$categories);
    }




   //List Of Comments
    public function listComments(Request $request)
    {
        $restaurant = Restaurant::with('clients')->where(['id' => $request->restaurant_id])->first();

        $commentValue =[];

        foreach ($restaurant['clients'] as $key => $value){

            $commentValue[$value->id] = ['user_id'=>$value->name , 'comment'=>$value->pivot->comment ,'rate'=>$value->pivot->rate];

        }
        return apiResponse(1,'List Of Comments ',$commentValue);



    }




}

