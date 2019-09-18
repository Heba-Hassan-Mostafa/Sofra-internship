@extends('layouts.app')
@section('page_header')
    Meals
@endsection

@section('content')



    <!-- Main content -->
    <section class="content">

<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title"> List Of Meals </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">

        <div class="card-body">
            <div>
                <a href="{{url(route('meal.create'))}}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> New Meal </a>
            </div>
            <br>

            <div class="col-md-4" style="float: right">
                <form action="{{url(route('meal.index'))}}" method="get" class="text-right">
                    <div class="input-group">
                        <input type="search" name="search" class="form-control" value="{{request()->search}}">
                        <button class="btn btn-primary input-group-prepend">Search</button>
                    </div>
                </form>

            </div>
            <br>
            <br>



            <!-- Start Table -->
                @if (count($meals))

                    <div class="table-responsive">
                        <table class="table table-bordered text-center">

                            <thead>
                            <tr>

                                <th>ID</th>
                                <th>Restaurant</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>price</th>
                                <th>image</th>
                                <th>Discount</th>
                                <th>Preparation Time</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach($meals as $meal)
                                <tr>
                            <td>{{$meal->id}}</td>
                            <td>{{optional($meal->restaurant)->name}}</td>
                            <td>{{$meal->name}}</td>
                            <td>{{$meal->short_description}}</td>
                            <td>{{$meal->price}}</td>
                            <td>
                    <img height="50px" width="50px" src="{{url('image/'.$meal->image.'/')}}">
                            </td>
                            <td>{{$meal->discount_price}}</td>
                            <td>{{$meal->preparation_time}}</td>

        <td>
            <a href="{{url(route('meal.edit', $meal->id))}}" class="btn btn-success">
                <i class="fa fa-edit"></i>Edit</a>
        </td>
                        <td>
                            <form action="{{(route('meal.destroy', $meal->id))}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash-o"></i>Delete</button>
                            </form>

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
