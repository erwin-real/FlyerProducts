@extends('layouts.main')

@section('content')

    <div class="container-fluid mb-5">

        <!-- Page Heading -->
        <h1 class="h2 mb-0 text-gray-800">Products</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Products</li>
            </ol>
        </nav>

    @include('includes.messages')

    <!-- Content Row -->
        <div class="row">
            <div class="container-fluid">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="float-left">Products</h5>
                        {{--<a href="/products/create" class="btn btn-outline-primary float-right"><i class="fas fa-plus"></i> Add Product</a>--}}
                        <div class="clearfix"></div>
                    </div>

                    <div class="card-body mt-2">
                        @if ($products->isEmpty())
                            <p> There are no products yet.</p>
                        @else
                            {{--{{$products->links()}}--}}
                            <div class="table-responsive">
                                <table class="table table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Attributes</th>
                                            <th>Combinations</th>
                                            <th>Date Added</th>
                                            <th>Date Modified</th>
                                            {{--<th>Actions</th>--}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                            <tr>
                                                <td><a href="/flyerproducts/products/{{$product->entity_id}}">{{$product->sku}}</a></td>
                                                <td>{{count($product->attributes)}}</td>
                                                <td>{{count($product->attributeCombinations)}}</td>
{{--                                                <td>{{ $product->details }}</td>--}}
                                                <td>{{ date('D M d, Y h:i a', strtotime($product->created_at)) }}</td>
                                                <td>{{ date('D M d, Y h:i a', strtotime($product->updated_at)) }}</td>
                                                {{--<td>--}}
                                                    {{--<a href="/products/{{$product->id}}/edit"><i class="fa fa-tools"></i></a>--}}
                                                    {{--<a href="/combinations?id={{$product->id}}"><i class="fa fa-cogs"></i></a>--}}
                                                {{--</td>--}}
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