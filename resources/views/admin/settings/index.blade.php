@extends('layouts.app')
@inject('model','App\Models\Setting')

@section('page_header')

    Settings
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"></h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">




                {!! Form::model($model,[
                            'action'=>['WebController\SettingController@store'],
                            'method'=>'Post',
                            ])!!}
                @foreach($records as $record)
                <div class="form-group ">
                        <label for="title">Title</label>
                        <input class="form-control" type="text" name="title" value="{{$record->title}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email </label>
                        <input class="form-control" type="text" name="email" value="{{$record->email}}" >
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone </label>
                        <input class="form-control" type="text" name="phone" value="{{$record->phone}}">
                    </div>
                <div class="form-group">
                    <label for="commission">Commission </label>
                    <input class="form-control" type="text" name="commission" value="{{$record->commission}}">
                </div>
                    <div class="form-group">
                        <label for="commissions_text1">Commission_Text1 </label>
                        <input class="form-control" type="text" name="commissions_text1" value="{{$record->commission_text1}}">
                    </div>
                    <div class="form-group">
                        <label for="commissions_text2">Commission_Text2</label>
                        <input class="form-control" type="text" name="commissions_text2" value="{{$record->commission_text2}}" >
                    </div>
                    <div class="form-group">
                        <label for="about_app">About_App</label>
                        <input class="form-control" type="text" name="about_app" value="{{$record->about_app}}" >
                    </div>


                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                    @include('flash::message')
            @include('admin.partial.validation-errors')

                @endforeach
                {!! Form::close() !!}

            <!-- /.card-body -->

            </div>
            <!-- End card -->
        </div>
    </section>
    <!-- End Section -->
@endsection
