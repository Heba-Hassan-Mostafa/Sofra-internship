<?php

namespace App\Http\Controllers\Api\Client;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{
    // Add Comment
    public function comment(Request $request)
    {
        $validation=validator()->make($request->all(),[

            'restaurant_id'=>'required| exists:restaurants,id',
            'rate'=>'required|in:1,2,3,4,5',
            'comment'=>'required'

        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return apiResponse(0, $validation->errors()->first(), $validation->errors(), $data);
        }

        $client=$request->user();
        $client->restaurants()->detach($request->restaurant_id);
        $client->restaurants()->attach([$request->restaurant_id =>[
            'rate'=>$request->rate,
            'comment'=>$request->comment

        ]]);

        // Update Restaurant Rate(Average Of Rate)

        $rate=Restaurant::find($request->restaurant_id)->comments()->avg('rate');
        Restaurant::find($request->restaurant_id)->update(['rate'=>$rate]);

        return apiResponse(1,'The restaurant was rated');

    }







    //contacts Function
    public function contacts(Request $request){
        // rules
        $validation = validator()->make($request->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'message' => 'required',
                'note' => 'required|in:complain,suggestion,enquiry',

            ]);

        if ($validation->fails()) {
            return apiResponse(0, $validation->errors()->first(), $validation->errors());
        }

        //Create
        $contacts= $request->user()->contacts()->create($request->all());;

        return apiResponse(1,'success',$contacts);




    }


    //list Of Notifications

    public function listNotification(Request $request){

        $notifications = $request->user()->notifications()->get();
       // dd($notifications);
        return apiResponse(1,'List Of Notifications',$notifications);


    }

    // Count Notifications

    public function count(Request $request){
        $count=$request->user()->notifications()->where(function ($query) {
            $query->where('is_read',0) ;
        })->count();
        return apiResponse(1,'load',[
            'notifications_count' => $count
        ]);
    }
}
