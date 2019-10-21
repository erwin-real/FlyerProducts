@extends('layouts.main')

@section('content')

    <div class="container-fluid mb-5">

        <!-- Page Heading -->
        <h1 class="h2 mb-0 text-gray-800">Users</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
        </nav>

    @include('includes.messages')

    <!-- Content Row -->
        <div class="row">
            <div class="container-fluid">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="float-left">Users</h5>
                        <a href="/flyerproducts/users/create" class="btn btn-outline-primary float-right"><i class="fas fa-plus"></i> Add User</a>
                        <div class="clearfix"></div>
                    </div>

                    <div class="card-body mt-2">
                        @if ($users->isEmpty())
                            <p> There are no other users yet.</p>
                        @else
                            {{--{{$users->links()}}--}}
                            <div class="table-responsive">
                                <table class="table table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Date Added</th>
                                            <th>Date Modified</th>
                                            {{--<th>Actions</th>--}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td><a href="/flyerproducts/users/{{$user->id}}">{{$user->name}}</a></td>
                                                <td>{{$user->email}}</td>
                                                <td>{{ date('D M d, Y h:i a', strtotime($user->created_at)) }}</td>
                                                <td>{{ date('D M d, Y h:i a', strtotime($user->updated_at)) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>


    </div>

@endsection