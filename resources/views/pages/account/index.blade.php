@extends('layouts.main')

@section('content')

    <div class="container-fluid mb-5">

        <!-- Page Heading -->
        <h1 class="h2 mb-0 text-gray-800">Account</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Account</li>
            </ol>
        </nav>

    @include('includes.messages')


        <div class="mt-5 col-lg-5 col-sm-5">
            <div class="card shadow">
                <div class="card-header ">
                    <h5><strong>Name</strong>: {{ $account->name }}</h5>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">

                    {{--<div class="form-group row d-block text-center">--}}
                        {{--<label class="col-md-12 col-form-label text-md-left"><b>{{ __('Photo') }}</b></label>--}}
                        {{--<img class="img-thumbnail rounded" src="/storage/user/{{$account->image}}" alt="">--}}
                    {{--</div>--}}

                    <p> <strong>Email</strong>: {{ $account->email ? $account->email : 'none'}}</p>
                    {{--<p> <strong>Type</strong>: {{ $account->type }}</p>--}}
                    {{--<p> <strong>User Group</strong>: {{ $account->group }}</p>--}}
                    {{--<p> <strong>Birthday</strong>: {{ $account->birthday ? date('M d, Y', strtotime($account->birthday)) : 'none'}}</p>--}}
                    {{--<p> <strong>Address</strong>: {{ $account->address ? $account->address : 'none'}}</p>--}}
                    {{--<p> <strong>Landline</strong>: {{ $account->landline ? $account->landline : 'none'}}</p>--}}
                    {{--<p> <strong>Mobile No.</strong>: {{ $account->mobile ? $account->mobile : 'none'}}</p>--}}
                    <p> <strong>Created at</strong>: {{ date('D m-d-Y h:i a', strtotime($account->created_at)) }}</p>
                    <p> <strong>Updated at</strong>: {{ date('D m-d-Y h:i a', strtotime($account->updated_at)) }}</p>
                    <a href="{{ action('AccountController@showChangePasswordForm') }}" class="btn btn-outline-warning float-left mr-2"><i class="fa fa-user-lock"></i> Change Password</a>

                    <div class="clearfix"></div>
                </div>

            </div>

        </div>


    </div>

@endsection