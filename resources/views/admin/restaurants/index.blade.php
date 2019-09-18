@extends('layouts.app')
@inject('user','App\Models\User')
@inject('city','App\Models\City')

@section('page_header')
    Restaurants
@endsection


@php
    $cities = $city->pluck('name','id')->toArray();
@endphp

@section('content')



    <!-- Main content -->
    <section class="content">

<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">   List Of Restaurants </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
{{--        <div>--}}
{{--            <a href="{{url(route('restaurant.create'))}}" class="btn btn-primary">--}}
{{--                <i class="fa fa-plus"></i> New Restaurant </a>--}}
{{--        </div>--}}
{{--        <br>--}}
        <div class="col-md-4" style="float: right">
            <form action="{{url(route('restaurant.index'))}}" method="get" class="text-right">
                <div class="input-group">
                    <input type="search" name="search" class="form-control" value="{{request()->search}}">
                    <button class="btn btn-primary input-group-prepend">Search</button>
                </div>
            </form>

        </div>
        <br>
       <br>

                <!-- Start Table -->
                @if (count($restaurants))

                    <div class="table-responsive">
                        <table class="table table-bordered text-center">

                            <thead>
                            <tr>

                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>District</th>
{{--                              <th>Categories</th>--}}
                                <th>Status</th>
                                <th>Activation</th>
                                <th>Activation-State</th>
                                <th>Delete</th>
{{--                                <th>Meals</th>--}}

                            </tr>

                            </thead>
                            <tbody>
                            @foreach($restaurants as $restaurant)
                                <tr>
                    <td>{{$restaurant->id}}</td>
                    <td><a style="cursor: pointer" data-toggle="modal" data-target="#myModal{{$restaurant->id}}">{{$restaurant->name}}</a></td>
                            <td>{{$restaurant->email}}</td>
                            <td>{{$restaurant->phone}}</td>
                            <td>{{optional($restaurant->district)->name}}</td>
{{--                            <td>{{optional($restaurant->categories)->name}}  </td>--}}


                          {{--Status--}}
                                    <td class="text-center">
                                        @if($restaurant->status == 'open')
                                            <i class="far fa-check-circle text-success"></i> Open
                                        @else
                                            <i class="fas fa-times-circle text-danger"></i> Closed
                                        @endif

                                    </td>


{{--         Activation--}}
            <td class="text-center">
                @if($restaurant->activated)
                    <a href="client/{{$restaurant->id}}/de-activate" class="btn btn-xs btn-danger"><i class="fa fa-close"></i> Stop Activate</a>
                @else
                    <a href="client/{{$restaurant->id}}/activate" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Do Activate</a>
                @endif
            </td>
            <td>{{$restaurant->activated}}</td>

                  <td>
        <form action="{{(route('restaurant.destroy', [$restaurant->id]))}}" method="post">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger">
                <i class="fa fa-trash-o"></i>Delete</button>
        </form>

    </td>
{{--                <td>--}}
{{--                    <a href="{{url(route('restaurant.meal.index',$restaurant->id))}}" class="btn btn-primary">Meals</a>--}}
{{--                </td>--}}



    </tr>


    <!-- Modal -->
    <div class="modal fade" id="myModal{{$restaurant->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">{{$restaurant->name}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <ul>
                                <li> City :
                                    {{$restaurant->district->city->name}}
                                    <br>
                                      District: {{$restaurant->district->name}}
                                </li>
                                <li> Minimum Charge : {{$restaurant->min_price}}</li>
                                <li> Contacts : {{$restaurant->phone}}</li>
                                <hr>
                                <li>Total Orders: {{$restaurant->total_orders_amount}}</li>
                                <li> Total Commission : {{$restaurant->total_commissions}}</li>
                                <li>Total Payments : {{$restaurant->total_payments}}</li>
                                <li> Net Commissions: {{$restaurant->total_commissions - $restaurant->total_payments}}</li>
                            </ul>
                        </div>
                        <div class="col-lg-4">
                            <img height="150px" width="150px" src="{{url('/'.$restaurant->photo.'/')}}"/>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
               </div>
                </div>
             @endforeach
                            </tbody>
                        </table>
                    </div>

{{--        @else--}}
{{--            <div class="alert alert-danger" role="alert">--}}
{{--                No Data--}}
{{--            </div>--}}
    @endif

    <!-- End Table -->

    @include('flash::message')

    </div>


    <!-- /.card-body -->

    </div>
    <!-- End card -->

    </section>
    <!-- End Section -->
    @endsection











