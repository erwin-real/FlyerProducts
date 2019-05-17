@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Products</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card-body mt-2">
                        @if ($products->isEmpty())
                            <p> There are no products yet.</p>
                        @else
                            {{--{{$products->links()}}--}}
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Details</th>
                                            <th>Date Added</th>
                                            <th>Date Modified</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td><a href="/products/{{$product->id}}">{{$product->name}}</a></td>
                                            <td>{{ $product->details }}</td>
                                            <td>{{ date('D M d, Y h:i a', strtotime($product->created_at)) }}</td>
                                            <td>{{ date('D M d, Y h:i a', strtotime($product->updated_at)) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                    {{--<a href="/products/create" class="btn btn-outline-success">Add Product</a>--}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
