@extends('layouts.main')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h2 mb-0 text-gray-800">Dashboard</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
        </div>


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

        </div>

    </div>

@endsection