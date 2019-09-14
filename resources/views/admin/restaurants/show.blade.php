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
    <div class="box box-primary">
        <div class="box-header">
            <div class="clearfix"></div>
            <br>


        <div class="box-body">

                <div class="table-responsive">
                    <table class="table table-bordered">

                        <thead>
                        <tr>
                        <th>ID</th>
                        <th>Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($restaurants as $restaurant)
        <tr>
            <td>{{$restaurant->id}}</td>
            <td><a style="cursor: pointer" data-toggle="modal" data-target="#myModal{{$restaurant->id}}">{{$restaurant->name}}</a></td>



        </tr>

            <!-- Modal -->

<div class="modal fade" id="myModal{{$restaurant->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">{{$restaurant->name}}</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-8">
                    <ul>
                        <li> العنوان :  {{$restaurant->address}}</li>
                        <li> المدينة :
                            ($restaurant->district)
                                {{$restaurant->district->name}}
                                    {{$restaurant->district->city->name}}
                        </li>
                        <li> الحد الأدنى للطلبات : {{$restaurant->min_price}}</li>
                        <li> للتواصل : {{$restaurant->phone}}</li>
                        <hr>
                        <li>إجمالي العمولات المستحقة : {{$restaurant->total_commissions}}</li>
                        <li>إجمالي المبالغ المسددة : {{$restaurant->total_payments}}</li>
                        <li>صافي العمولات المستحقة : {{$restaurant->total_commissions - $restaurant->total_payments}}</li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <img height="150px" width="150px" src="{{url('/'.$restaurant->photo.'/')}}"/>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button>
        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>



        </div>
    </div>
    </div>
@endsection