<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    // New Order from Client

    public function newOrder(Request $request)
    {
        $order = $request->user()->orders()->where('status', 'pending')->get();

        if (!$order) {
            return apiResponse(0, 'There Is No orders for this restaurant');

        }

        return apiResponse(1, 'success', $order);


    }

    // Accepted Orders(The Accepting Button)
    public function acceptOrder(Request $request)
    {
        $order = $request->user()->orders()->find($request->order_id);

        if (!$order) {
            return apiResponse(0, 'This order doesnt exist ');
        }

        $order->update([
            'status' => 'accepted'
        ]);

        //find Client To Send Notification

        $client = Client::find($order->client->id);

        //send Notification
        $notification = $client->notifications()->create([

            'title' => ' Client : Accepted Order ',

            'content' => ' Your Order has been accepted ' . $order->client->name . ' by ' . $request->user()->name,

            'order_id' => $order->id,

        ]);

        // Notification Parameter
        $tokens = $client->tokens()->where('token', '!=', '')->pluck('token')->toArray();

        $title = $notification->title;

        $content = $notification->content;

        $data = [

            'title' => ' Client : Accepted Order ',

            'content' => ' Your Order has been accepted ' . $order->client->name . ' by ' . $request->user()->name,

            'order_id' => $order->id,

        ];

        $send = notifyByFirebase($title, $content, $tokens, $data);

        return apiResponse(1, 'the order is accepted  ', [

            'status' => $order->status,

            'client' => $order->client->name,

            'order' => $order

        ]);


    }

    // Rejected Orders(The Rejected Button)

    public function rejectOrder(Request $request)
    {
        $order = $request->user()->orders()->find($request->order_id);

        if (!$order) {
            return apiResponse(0, 'This order doesnt exist ');
        }

        $order->update([
            'status' => 'rejected'
        ]);

        //find Client To Send Notification

        $client = Client::find($order->client->id);

        //send Notification
        $notification = $client->notifications()->create([

            'title' => ' Client : Rejected Order ',

            'content' => ' Your Order has been rejected ' . $order->client->name . ' by ' . $request->user()->name,

            'order_id' => $order->id,

        ]);

        // Notification Parameter
        $tokens = $client->tokens()->where('token', '!=', '')->pluck('token')->toArray();

        $title = $notification->title;

        $content = $notification->content;

        $data = [

            'title' => ' Client : Rejected Order ',

            'content' => ' Your Order has been rejected ' . $order->client->name . ' by ' . $request->user()->name,

            'order_id' => $order->id,

        ];

        $send = notifyByFirebase($title, $content, $tokens, $data);

        return apiResponse(1, 'the order is rejected  ', [

            'status' => $order->status,

            'client' => $order->client->name,

            'order' => $order

        ]);

    }


    // delivery Order (confirm order)

    public function deliveryOrder(Request $request)
    {
        $order = $request->user()->orders()->find($request->order_id);

        if (!$order) {
            return apiResponse(0, 'This order doesnt exist ');
        }

        $order->update([
            'status' => 'delivered'
        ]);

        return apiResponse(1 , 'success , order is delivered to the client ', [

            'status'=>$order->status,

            'order' =>$order,

        ]);


    }

    //List Of Accepted Order
    public function listAccept(Request $request)
    {
        $order=  $request->user()->orders()->where('status','accepted')->get();

        if(!$order){

            return apiResponse(0,'There Is no orders for this restaurant');

        }

        return apiResponse(1,'success',$order);



    }

    //List Of Rejected and Delivered Order

    public function listReject(Request $request)
    {
        $order=  $request->user()->orders()->whereIn('status',['rejected','delivered'])->get();

        if(!$order){

            return apiResponse(0,'There Is no orders for this restaurant');

        }

        return apiResponse(1,'success',$order);



    }

    //list Of Notifications

    public function listNotification(Request $request){

        $notifications = $request->user()->notifications()->get();
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

    public function commission(Request $request)
    {
        $count = $request->user()->orders()->where('status','delivered')->count();
        $restaurant_sales=$request->user()->orders()->where('status','delivered')->sum('total_price');
        $app_commission = $request->user()->orders()->where('status','delivered')->sum('commission');
        $payments = $request->user()->payments()->sum('paid');
        $restaurant_payments = $request->user()->payments()->pluck('paid')->first();
        $rest_of_commissions = $app_commission - $restaurant_payments ;
        $commission = settings()->commission;
        return apiResponse(1, 'success', compact('count','restaurant_sales', 'app_commission', 'restaurant_payments'
            , 'rest_of_commissions', 'commission'));

    }

    public function changeStatus(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'status' => 'required|in:open,close'
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return apiResponse(0,$validation->errors()->first(),$data);
        }
        $request->user()->update(['status' => $request->status]);
        return apiResponse(1,'',$request->user());
    }

}