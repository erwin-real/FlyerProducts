@extends('layouts.main')

@section('content')

    <div class="container-fluid mb-5">

        <!-- Page Heading -->
        <h1 class="h2 mb-0 text-gray-800">Users</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page">
                    <a href="/flyerproducts/users">Users</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="/flyerproducts/users/{{$user->id}}">{{$user->name}}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
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
                    <form class="form-horizontal" method="POST" action="/flyerproducts/users/change-password">
                        <input type="hidden" name="id" value="{{$user->id}}">
                        {{ csrf_field() }}

                        <div class="form-group row{{ $errors->has('new-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="col-md-4 col-form-label">{{ __('New Password') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="new-password" type="password"
                                       class="form-control{{ $errors->has('new-password') ? ' is-invalid' : '' }}"
                                       name="new-password" required autofocus>

                                @if ($errors->has('new-password'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('new-password-confirm') ? ' has-error' : '' }}">
                            <label for="new-password-confirm" class="col-md-4 col-form-label">{{ __('Confirm New Password') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="new-password-confirm" type="password"
                                       class="form-control{{ $errors->has('new-password-confirm') ? ' is-invalid' : '' }}"
                                       name="new-password_confirmation" required autofocus>
                            </div>
                        </div>

                        <div class="form-group text-center mt-5">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="fa fa-user-check"></i> Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>


    </div>

@endsection