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
                <h3 class="card-title">Edit Meal </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                {!! Form::model($model,[
                    'action'=>['WebController\MealController@update',$model->id],
                    'method'=>'put'
                                ]) !!}

                <div class="form-group">
                    <label for="name">Name</label>
                    {!! Form::text('name',null,[
                    'class'=>'form-control'
                    ]) !!}
                </div>


                <div class="form-group">
                    <label for="image">image</label>
                    {!! Form::file('image',[
                    'class'=>'form-control'
                    ]) !!}
                </div>

                <div class="form-group">
                    <label for="discount_price">Discount</label>
                    {!! Form::number('discount_price',null,[
                    'class'=>'form-control'
                    ]) !!}
                </div>

                <div class="form-group">
                    <label for="price">price</label>
                    {!! Form::number('price',null,[
                    'class'=>'form-control'
                    ]) !!}
                </div>
                <div class="form-group">
                    <label for="preparation_time">Preparation Time</label>
                    {!! Form::text('preparation_time',null,[
                    'class'=>'form-control'
                    ]) !!}
                </div>

                <div class="form-group">
                    <label for="short_description">Description</label>
                    {!! Form::textarea('short_description',null,[
                    'class'=>'form-control'
                    ]) !!}
                </div>

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>

{{--            @include('admin.meals.form')--}}
                @include('admin.partial.validation-errors')
                    @include('flash::message')
                {!! Form::close() !!}




            <!-- /.card-body -->

            </div>
            <!-- End card -->
        </div>
    </section>
    <!-- End Section -->
@endsection
