@extends('layouts.app')
@inject('client','App\Models\Client')
@inject('city','App\Models\City')
@inject('category','App\Models\Category')
@inject('restaurant','App\Models\Restaurant')
@inject('offer','App\Models\Offer')
@inject('contact','App\Models\Contact')
@inject('setting','App\Models\Setting')
@inject('order','App\Models\Order')
@inject('meal','App\Models\Meal')

@section('page_header')
    Dashboard
@endsection
@section('page_description')
    Statistics
@endsection

@section('content')



    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!--Clients-->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fa fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Clients</span>
                        <span class="info-box-number">{{$client->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!--Cities-->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"> <i class="fas fa-map-marker-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Cities</span>
                        <span class="info-box-number">{{$city->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!--Categories-->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fa fa-list"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Categories</span>
                        <span class="info-box-number">{{$category->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!--Restaurants-->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fas fa-utensils"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Restaurant</span>
                        <span class="info-box-number">{{$restaurant->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- Meals-->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fad fa-french-fries"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"> Meals</span>
                        <span class="info-box-number">{{$meal->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- Offers -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-list"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Offers</span>
                        <span class="info-box-number">{{$offer->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- Orders-->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fad fa-french-fries"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"> Orders</span>
                        <span class="info-box-number">{{$order->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!--Contact Us-->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"> <i class="fas fa-phone"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Contact Us</span>
                        <span class="info-box-number">{{$contact->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <!-- Settings -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fas fa-cogs"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"> Settings</span>
                        <span class="info-box-number">{{$setting->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>


        </div>

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Title</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                You are logged in!
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                Footer
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
