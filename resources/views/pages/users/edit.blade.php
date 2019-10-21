@extends('layouts.main')

@section('content')

    {{-- Right Content --}}
    <div class="body-right">
        <div class="container-fluid mb-5">
            <h1 class="h2 mb-0 text-gray-800">Update User</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="/flyerproducts/users">Users</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="/flyerproducts/users/{{$user->id}}">{{$user->name}}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Update User</li>
                </ol>
            </nav>

            @include('includes.messages')

            <div class="container-fluid mt-5 col-lg-6 col-sm-7">
                <div class="card shadow mb-4">
                    <div class="card-header">{{ __('User\'s Information') }}</div>

                    <div class="card-body">

                        <form action="{{ action('UserController@update', $user->id) }}" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            @csrf

                            {{-- NAME --}}
                            <div class="form-group row">
                                <label for="name" class="col-md-12 col-form-label text-md-left">Name <span class="text-danger">*</span></label>

                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$user->name}}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- EMAIL ADDRESS --}}
                            <div class="form-group row">
                                <label for="email" class="col-md-12 col-form-label text-md-left">Email Address <span class="text-danger">*</span></label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$user->email}}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0 mt-4 text-center">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-outline-primary">
                                        <i class="fa fa-check"></i> {{ __('Save') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
