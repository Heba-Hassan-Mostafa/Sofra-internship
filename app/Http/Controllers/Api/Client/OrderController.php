<?php

namespace App\Http\Controllers\Api\Client;

use App\Models\Meal;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    // Create Client Order

    public function createOrder(Request $request)
    {
        $validation=validator()->make($request->all(),[

            'restaurant_id'=>'required|exists:restaurants,id',
            'meals.*.meal_id'=>'required|exists:meals,id',
            'meals.*.quantity'=>'required',
            'address'=>'required'

        ]);

        if ($validation->fails()){
            return apiResponse(0,$validation->errors()->first(),$validation->errors());
        }

        //Select Restaurant
        $restaurant=Restaurant::find($request->restaurant_id);


        // Check The Status Of Restaurant (open or close)
        if ($restaurant->status=='close'){

            return apiResponse(0,'Sorry,The Restaurant Not available now');
        }

        //create order

        $order=$request->user()->orders()->create([
            'restaurant_id'=>$request->restaurant_id,
            'notes'=>$request->notes,
            'address'=>$request->address,
            'status'=>'pending'

        ]);



        $price = 0;

        $delivery_price=$restaurant->delivery_price;

        foreach ($request->meals as $m)
        {
            //find meal with id
            $meal=Meal::find($m['meal_id']);

            // To make attach (many to many ->order & meal )->use pivot table
            $readyorder=[
                $m['meal_id']=>[
                    'quantity'=>$m['quantity'],
                    'price'=> $meal->price,
                    'specialorder_note'=>(isset($m['specialorder_note']))? $m['specialorder_note'] : ''

                ]
            ];

            $order->meals()->attach($readyorder);
            $price +=($meal->price * $m['quantity']);


        }

        //validation if order > min_price

        if ($price >= $restaurant->min_price){

            $total=$price + $delivery_price;
           $commission= settings()->commission * $price;

            $update=$order->update([

                'price'=>$price,
                'total_price'=>$total,
                'delivery_price'=>$delivery_price,
                'commission'    => $commission,
            ]);

            // Create Notifications

            $notification=$restaurant->notifications()->create([
                'title'=>'You have new order',
                'content'=>'You have new order by client'.$request->user()->name,
                'order_id'=>$order->id

            ]);
            $tokens=$restaurant->tokens()->where('token','!=','')->pluck('token')->toArray();
            info("tokens: ".count($tokens));
            if (count($tokens)){
               info("tokens: ".json_encode($tokens));
                $title=$notification->title;
                $body=$notification->content;
                $data=[
                    'user_type'=>'restaurant',
                    'action'=>'new order',
                    'title'=>'You have new order',
                    'content'=>'You have new order by client'.$request->user()->name,
                    'order_id' => $order->id

                ];


                $send = notifyByFirebase($title,$body,$tokens,$data,true);
               info('firebase result:'.$send);
            }




          return apiResponse(1,'Successfully Added',compact('order'));



        }
        else{
            $order->meals()->delete();
            $order->delete();
            return apiResponse(0,'The order must not be less than'.$restaurant->min_price.'pound');
        }



    }



    // Order Details

    public function orderDetail(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->meals()->where('meal_id', $request->meal_id)->get();

        if (!$order) {

            return apiResponse(0, 'This order not found');
        }



            return apiResponse(1, 'success', $order);
        }



        //List Of New Orders
    public function newOrder(Request $request)
    {
        $order = $request->user()->orders()->where('status','accepted')->get();

        if (!$order) {
            return apiResponse(0, 'There Is No orders for this restaurant');

        }

        return apiResponse(1, 'success', $order);


    }


    // Accepted Orders(The Accepting Button)

    public function accept(Request $request)
    {
        $order = $request->user()->orders()->find($request->order_id);

        if (!$order) {
            return apiResponse(0, 'There Is No orders for this restaurant');

        }

        $order->update([
            'status' => 'delivered',
        ]);
        // find the restaurant that will receive the notification

        $restaurant = Restaurant::find($order->restaurant->id);
        // dd($restaurant);
        // create notification
        $notification =  $restaurant->notifications()->create([
            'title'  => ' Restaurant : Delivered Order   ',
            'content'  => ' Your Order has been delivered and accepted by  '.$request->user()->name,
            'order_id' =>$order->id ,
        ]);

        // notification parameters
        $tokens = $restaurant ->tokens()->where('token','!=','')->pluck('token')->toArray();
        $title = $notification->title ;
        $content = $notification->content ;
        $data = [
            'title'  => ' Restaurant : Delivered Order   ',
            'body'  => ' Your Order has been delivered and accepted by  '.$request->user()->name,
            'order_id' =>$order->id ,
        ];
        $send = notifyByFirebase($title,$content,$tokens,$data);
        return apiResponse(1,' Success, delivered Order ',[
            'Order status' => 'delivered',
            'Notification status' => 'Restaurant',
            'Order'=>$order
        ]);


    }


    // Declined Orders(The Accepting Button)

    public function declineOrder(Request $request)
    {
        $order = $request->user()->orders()->find($request->order_id);

        if (!$order) {
            return apiResponse(0, 'There Is No orders for this restaurant');

        }

        $order->update([
            'status' => 'declined',
        ]);
        // find the restaurant that will receive the notification

        $restaurant = Restaurant::find($order->restaurant->id);
        // dd($restaurant);
        // create notification
        $notification =  $restaurant->notifications()->create([
            'title'  => ' Restaurant : declined Order   ',
            'content'  => ' Your Order has been declined and accepted by  '.$request->user()->name,
            'order_id' =>$order->id ,
        ]);

        // notification parameters
        $tokens = $restaurant ->tokens()->where('token','!=','')->pluck('token')->toArray();
        $title = $notification->title ;
        $content = $notification->content ;
        $data = [
            'title'  => ' Restaurant : declined Order   ',
            'body'  => ' Your Order has been declined and accepted by  '.$request->user()->name,
            'order_id' =>$order->id ,
        ];
        $send = notifyByFirebase($title,$content,$tokens,$data);
        return apiResponse(1,' Success, declined Order ',[
            'Order status' => 'declined',
            'Notification status' => 'Restaurant',
            'Order'=>$order
        ]);


    }

    //List Of Previous Order
    public function previousOrder(Request $request){
            $order = $request->user()->orders()->where('status','delivered')->get();
            //     dd($order);
            if(!$order){
                return apiResponse(0 , 'failed , there is no previous orders for this client') ;
            }
            return apiResponse (1,' Success',[
                ' Order status ' => 'previous delivered',
                ' Order '=>$order
            ]);

    }
}
