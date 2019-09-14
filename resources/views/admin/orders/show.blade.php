@extends('layouts.app')
@section('page_header')
    Order-Details
@endsection

@section('content')

    <div class="card">
        <div class="card-body">

            @include('flash::message')
            @if(!empty($order))

                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                            <i class="fa fa-globe"></i> Order No ->  {{$order->id}}
                        </h2>
                            <h3 class="card-title"><i class="fa fa-calendar"></i>  {{$order->created_at}} </h3>

                    </div>
                </div>
            <hr>
        <!-- client row -->
        <div class="row">
            <div class="col-sm-4">
               <h4>Order From</h4>
                <address>
                    <i class="far fa-check-circle text-success"></i><strong>{{$order->client->name}}</strong>
                    <br>
                    <i class="far fa-check-circle text-success"></i>   Phone : {{$order->client->phone}}
                    <br>
                    <i class="far fa-check-circle text-success"></i>  Email  : {{$order->client->email}}
                    <br>
                    <i class="far fa-check-circle text-success"></i>  Address : {{$order->address}}
                </address>
            </div>

            <!-- Restaurant row -->
        <div class="col-sm-4">
            <h4> Order To </h4>
            <address>
               <i class="far fa-check-circle text-success"></i> <strong>  {{$order->restaurant->name}}</strong>
                <br>
                <i class="far fa-check-circle text-success"></i> Address : {{$order->restaurant->district->name}}
                <br>
                <i class="far fa-check-circle text-success"></i>  Phone :  {{$order->restaurant->phone}}
            </address>
        </div>
            <!-- Order row -->
        <div class="col-sm-4">
            <h4> Order Details </h4>
            <address>
           <i class="far fa-check-circle text-success"></i> Order No :{{$order->id}}
            <br>
            <i class="far fa-check-circle text-success"></i> Status :{{$order->status}}
                <br>
                <i class="far fa-check-circle text-success"></i> Total: {{$order->total_price}}

            </address>
    </div>
    </div>

    <!-- Table -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Meal Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Notes</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->meals as $meal)
                                    <tr>
                                        <td>{{$meal->id}}</td>
                                        <td>{{$meal->name}}</td>
                                        <td>{{$meal->pivot->quantity}}</td>
                                        <td>{{$meal->pivot->price}}</td>
                                        <td>{{$meal->pivot->specialorder_note}}</td>

                                    </tr>
                                @endforeach
                                <tr>
                                    <td>--</td>
                                    <td>delivery Price</td>
                                    <td>-</td>
                                    <td>{{$order->delivery_price}}</td>
                                    <td></td>
                                </tr>
                                <tr class="bg-success">
                                    <td>--</td>
                                    <td>Total</td>
                                    <td>-</td>
                                    <td>
                                        {{$order->total_price}}
                                    </td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
            @endif
                </div>
       </div>

@endsection