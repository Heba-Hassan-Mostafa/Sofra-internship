@extends('layouts.app')
@inject('restaurant','App\Models\Restaurant')
<?php
$restaurants = $restaurant->pluck('name','id')->toArray();
?>
@section('page_header')
    Orders
@endsection

@section('content')



    <!-- Main content -->
    <section class="content">

<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">   List Of Orders </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">

        <div class="col-md-4" style="float: right">
            <form action="{{url(route('order.index'))}}" method="get" class="text-right">
                <div class="input-group">
                    <input type="search" name="search" class="form-control" value="{{request()->search}}">
                    <button class="btn btn-primary input-group-prepend">Search</button>
                </div>
            </form>


        </div>
        <br>
       <br>


                <!-- Start Table -->
                @if (count($records))

                    <div class="table-responsive">
                        <table class="table table-bordered text-center">

                            <thead>
                            <tr>

                                <th>ID</th>
                                <th>Restaurant</th>
                                <th>Client-Address</th>
                                <th>Total Price</th>
                                <th>Delivery Price</th>
                                <th>Status</th>
                                <th>Notes</th>
                                <th>Order Time</th>
                                <th>Show</th>

                            </tr>

                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr>
                            <td>{{$record->id}}</td>
                            <td>{{optional($record->restaurant)->name}}</td>
                            <td>{{optional($record->client)->address}}</td>
                            <td>{{$record->total_price}}</td>
                           <td>{{$record->delivery_price}}</td>
                            <td>{{$record->status}}</td>
                             <td>{{$record->notes}}</td>
                            <td>{{$record->created_at}}</td>

            <td>
            <a href="{{url(route('order.show', $record->id))}}" class="btn btn-success btn-block">Show Order </a>
            </td>
                                </tr>
                            @endforeach


                            </tbody>

                        </table>
                    </div>

                @else
                    <div class="alert alert-danger" role="alert">
                        No Data
                    </div>
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
