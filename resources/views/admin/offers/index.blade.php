@extends('layouts.app')
@section('page_header')
    Offers
@endsection

@section('content')



    <!-- Main content -->
    <section class="content">

<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">   List Of Offers </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="col-md-4" style="float: right">
            <form action="{{url(route('offer.index'))}}" method="get" class="text-right">
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
                                <th>Name</th>
                                <th>Image</th>
                                <th>Content</th>
                                <th>Restaurant</th>
                                <th>Date-From</th>
                                <th>Date-To</th>
                                <th>Delete</th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr>
                            <td>{{$record->id}}</td>
                            <td>{{$record->name}}</td>
                            <td>{{$record->image}}</td>
                            <td>{{$record->content}}</td>
                            <td>{{optional($record->restaurant)->name}}</td>
                            <td>{{$record->date_from}}</td>
                             <td>{{$record->date_to}}</td>


                <td>
        <form action="{{(route('offer.destroy', [$record->id]))}}" method="post">
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
