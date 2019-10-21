@extends('layouts.main')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h2 mb-0 text-gray-800">Dashboard</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                <!-- <li class="breadcrumb-item" aria-current="page"><a href="/account">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Guide</li> -->
            </ol>
        </nav>
        @include('includes.messages')

        <!-- Content Row -->
        <div class="row">

            <!-- PRODUCTS -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Products</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($products)}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-puzzle-piece fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--<!-- USERS -->--}}
            @if(Auth::user()->is_admin)
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Users</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($users)}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{--<!-- Earnings (Monthly) Card Example -->--}}
            {{--<div class="col-xl-3 col-md-6 mb-4">--}}
                {{--<div class="card border-left-info shadow h-100 py-2">--}}
                    {{--<div class="card-body">--}}
                        {{--<div class="row no-gutters align-items-center">--}}
                            {{--<div class="col mr-2">--}}
                                {{--<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Materials</div>--}}
                                {{--<div class="h5 mb-0 font-weight-bold text-gray-800">{{count($materials)}}</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-auto">--}}
                                {{--<i class="fas fa-puzzle-piece fa-2x text-gray-300"></i>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<!-- Pending Requests Card Example -->--}}
            {{--<div class="col-xl-3 col-md-6 mb-4">--}}
                {{--<div class="card border-left-warning shadow h-100 py-2">--}}
                    {{--<div class="card-body">--}}
                        {{--<div class="row no-gutters align-items-center">--}}
                            {{--<div class="col mr-2">--}}
                                {{--<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Purchase Requests</div>--}}
                                {{--<div class="h5 mb-0 font-weight-bold text-gray-800">{{count($purchaseRequests)}}</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-auto">--}}
                                {{--<i class="fas fa-user-tag fa-2x text-gray-300"></i>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>

        {{--<div class="row">--}}

            {{--<div class="col-12 col-lg-6">--}}
                {{--<div class="card shadow mb-4">--}}
                    {{--<!-- Card Header - Dropdown -->--}}
                    {{--<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">--}}
                        {{--<h6 class="m-0 font-weight-bold text-primary">User's Photo</h6>--}}
                        {{--<div class="dropdown no-arrow">--}}
                            {{--<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                {{--<a href="/account/{{Auth::user()->id}}"><i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<!-- Card Body -->--}}

                    {{--<div class="card-body">--}}

                        {{--<div class="form-group d-block text-center">--}}
                            {{--<img class="img-thumbnail rounded" src="/storage/user/{{Auth::user()->image}}" alt="">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="col-12 col-lg-6">--}}
                {{--<div class="card shadow mb-4">--}}
                    {{--<!-- Card Header - Dropdown -->--}}
                    {{--<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">--}}
                        {{--<h6 class="m-0 font-weight-bold text-primary">User's Info</h6>--}}
                        {{--<div class="dropdown no-arrow">--}}
                            {{--<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                {{--<a href="/account/{{Auth::user()->id}}"><i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<!-- Card Body -->--}}

                    {{--<div class="card-body">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-md-6">--}}
                                {{--<p> <strong>Name</strong>: {{ Auth::user()->fname }} {{ Auth::user()->lname }}</p>--}}
                                {{--<p> <strong>Type</strong>: {{ Auth::user()->type }}</p>--}}
                                {{--<p> <strong>Email</strong>: {{ Auth::user()->email ? Auth::user()->email : 'none'}}</p>--}}
                                {{--<p> <strong>User Group</strong>: {{ Auth::user()->group }}</p>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6">--}}
                                {{--<p> <strong>Birthday</strong>: {{ Auth::user()->birthday ? date('M d, Y', strtotime(Auth::user()->birthday)) : 'none'}}</p>--}}
                                {{--<p> <strong>Address</strong>: {{ Auth::user()->address ? Auth::user()->address : 'none'}}</p>--}}
                                {{--<p> <strong>Landline</strong>: {{ Auth::user()->landline ? Auth::user()->landline : 'none'}}</p>--}}
                                {{--<p> <strong>Mobile No.</strong>: {{ Auth::user()->mobile ? Auth::user()->mobile : 'none'}}</p>--}}
                            {{--</div>--}}
                            {{--<div class="w-100 text-center">--}}
                            {{--<a href="{{ action('UsersController@editUser', Auth::user()->id) }}" class="btn btn-outline-info"><i class="fa fa-pencil-alt"></i> Edit</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<!-- Content Row -->--}}

        <div class="row">

            <!-- PRODUCTS -->
            <div class="col-12 col-lg-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Products Overview</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <a href="/flyerproducts/products"><i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a>
                            </a>
                        </div>
                    </div>
                    <!-- Card Body -->

                    <div class="card-body">
                        @if(count($products) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>SKU</th>
                                        <th>Attributes</th>
                                        <th>Combinations</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @for ($i = 0; ($i < 5 && $i < count($products)); $i++)
                                            <tr>
                                                <td><a href="/flyerproducts/products/{{$products[$i]->entity_id}}">{{$products[$i]->sku}}</a></td>
                                                <td>{{count($products[$i]->attributes)}}</td>
                                                <td>{{count($products[$i]->attributeCombinations)}}</td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        @else
                            No products yet ...
                        @endif
                    </div>
                </div>
            </div>

            {{--<!-- USERS -->--}}
            @if(Auth::user()->is_admin)
                <div class="col-12 col-lg-6">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Users Overview</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <a href="/flyerproducts/users"><i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a>
                                </a>
                            </div>
                        </div>
                        <!-- Card Body -->

                        <div class="card-body">
                            @if(count($users) > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email Address</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; ($i < 5 && $i < count($users)); $i++)
                                                <tr>
                                                    <td><a href="/flyerproducts/users/{{$users[$i]->id}}">{{$users[$i]->name}}</a></td>
                                                    <td>{{$users[$i]->email}}</td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                No other users yet ...
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            {{--<!-- MATERIALS -->--}}
            {{--<div class="col-12 col-lg-6">--}}
                {{--<div class="card shadow mb-4">--}}
                    {{--<!-- Card Header - Dropdown -->--}}
                    {{--<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">--}}
                        {{--<h6 class="m-0 font-weight-bold text-primary">Materials Overview</h6>--}}
                        {{--<div class="dropdown no-arrow">--}}
                            {{--<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                {{--<a href="/materials"><i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<!-- Card Body -->--}}

                    {{--<div class="card-body">--}}
                        {{--@if(count($materials) > 0)--}}
                            {{--<div class="table-responsive">--}}
                                {{--<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">--}}
                                    {{--<thead>--}}
                                    {{--<tr>--}}
                                        {{--<th>PLU</th>--}}
                                        {{--<th>Description</th>--}}
                                        {{--<th>Unit</th>--}}
                                    {{--</tr>--}}
                                    {{--</thead>--}}
                                    {{--<tbody>--}}
                                    {{--@for ($i = 0; ($i < 5 && $i < count($materials)); $i++)--}}
                                        {{--<tr>--}}
                                            {{--<td><a href="/materials/{{$materials[$i]->id}}">{{$materials[$i]->plu}}</a></td>--}}
                                            {{--<td>{{$materials[$i]->main_desc}}</td>--}}
                                            {{--<td>{{$materials[$i]->unit_measurement}}</td>--}}
                                        {{--</tr>--}}
                                    {{--@endfor--}}
                                    {{--</tbody>--}}
                                {{--</table>--}}
                            {{--</div>--}}
                        {{--@else--}}
                            {{--No materials yet ...--}}
                        {{--@endif--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<!-- PURCHASE REQUESTS -->--}}
            {{--<div class="col-12 col-lg-6">--}}
                {{--<div class="card shadow mb-4">--}}
                    {{--<!-- Card Header - Dropdown -->--}}
                    {{--<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">--}}
                        {{--<h6 class="m-0 font-weight-bold text-primary">Purchase Requests Overview</h6>--}}
                        {{--<div class="dropdown no-arrow">--}}
                            {{--<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                {{--<a href="/purchaseRequests"><i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<!-- Card Body -->--}}

                    {{--<div class="card-body">--}}
                        {{--@if(count($purchaseRequests) > 0)--}}
                            {{--<div class="table-responsive">--}}
                                {{--<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">--}}
                                    {{--<thead>--}}
                                    {{--<tr>--}}
                                        {{--<th>PR #</th>--}}
                                        {{--<th>Department</th>--}}
                                        {{--<th>Coordinator</th>--}}
                                    {{--</tr>--}}
                                    {{--</thead>--}}
                                    {{--<tbody>--}}
                                    {{--@for ($i = 0; ($i < 5 && $i < count($purchaseRequests)); $i++)--}}
                                        {{--<tr>--}}
                                            {{--<td><a href="/purchaseRequests/{{$purchaseRequests[$i]->id}}">{{$purchaseRequests[$i]->pr}}</a></td>--}}
                                            {{--<td>{{$purchaseRequests[$i]->department}}</td>--}}
                                            {{--<td><a href="/account/{{$purchaseRequests[$i]->user->id}}">{{$purchaseRequests[$i]->user->fname}} {{$purchaseRequests[$i]->user->lname}}</a></td>--}}
                                        {{--</tr>--}}
                                    {{--@endfor--}}
                                    {{--</tbody>--}}
                                {{--</table>--}}
                            {{--</div>--}}
                        {{--@else--}}
                            {{--No purchase requests yet ...--}}
                        {{--@endif--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>

    </div>

@endsection