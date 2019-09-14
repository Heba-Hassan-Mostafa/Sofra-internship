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
                <h3 class="card-title"></h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div>
                    <a href="{{url(route('user.create'))}}" class="btn btn-primary">
                        <i class="fa fa-plus"></i>Add User </a>
                </div>
                <br>
                <!-- Start Table -->
                @if (count($users))
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">

                            <thead>
                            <tr>

                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                        <span class="btn btn-primary">{{$role->display_name}}</span>

                                            @endforeach
                                    </td>
                                    <td class="text-center" >
                                        <a href="{{url(route('user.edit', $user->id))}}" class="btn btn-success">
                                            <i class="fa fa-edit"></i>Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{(route('user.destroy', [$user->id]))}}" method="post">
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
