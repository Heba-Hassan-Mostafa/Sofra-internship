@extends('layouts.app')
@section('page_header')
    Users
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit User </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
            {!! Form::model($model,[
                'action'=>['WebController\UserController@update',$model->id],
                'method'=>'put'
                            ]) !!}
            @include('admin.users.form')
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
