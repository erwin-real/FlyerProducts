@extends('layouts.main')

@section('content')

    {{-- Right Content --}}
    <div class="body-right">
        <div class="container-fluid mb-5">
            <h1 class="h2 mb-0 text-gray-800">{{$user->name}}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="/flyerproducts/users">Users</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{$user->name}}</li>
                </ol>
            </nav>

            @include('includes.messages')

            <div class="mt-5 col-lg-5 col-sm-5">
                <div class="card shadow">
                    <div class="card-header ">
                        <h5><strong>Name</strong>: {{ $user->name }}</h5>
                        <div class="clearfix"></div>
                    </div>
                    <div class="card-body">
                        <p> <strong>Email</strong>: {{ $user->email ? $user->email : 'none'}}</p>
                        <p> <strong>Created at</strong>: {{ date('D m-d-Y h:i a', strtotime($user->created_at)) }}</p>
                        <p> <strong>Updated at</strong>: {{ date('D m-d-Y h:i a', strtotime($user->updated_at)) }}</p>

                        {{--EDIT BUTTON--}}
                        <button class="btn btn-outline-primary">
                            <a href="/flyerproducts/users/{{$user->id}}/edit">
                                <i class="fas fa-pencil-alt fa-sm fa-fw"></i> Update
                            </a>
                        </button>

                        {{--CHANGE PASSWORD BUTTON--}}
                        <a href="/flyerproducts/users/change-password?id={{$user->id}}" class="btn btn-outline-warning">
                            <i class="fas fa-user-lock fa-sm fa-fw"></i> Change Password
                        </a>

                        {{--DELETE BUTTON--}}
                        <button class="btn btn-outline-danger" data-toggle="modal" data-target="#delUserModal">
                            <i class="fas fa-trash fa-sm fa-fw"></i>
                            Delete
                        </button>
                        <div class="clearfix"></div>
                    </div>

                </div>

            </div>
            <a href="/flyerproducts/users" class="btn btn-outline-primary mt-3"><i class="fas fa-chevron-left"></i> Back</a>
        </div>
    </div>

    {{--MODAL--}}
    <div class="modal fade" id="delUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this user?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Delete" below if you are sure on deleting this user.</div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>

                    <form id="delete" method="POST" action="{{ action('UserController@destroy', $user->id) }}" class="float-left">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div>
                            <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash"></i> Delete</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection