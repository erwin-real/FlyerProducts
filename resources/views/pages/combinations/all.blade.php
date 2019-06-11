@extends('layouts.main')

@section('content')

    <div class="container-fluid mb-5">

        <!-- Page Heading -->
        <h1 class="h2 mb-0 text-gray-800">Combinations</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page">
                    <a href="/products">Products</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="/products/{{$product->id}}">{{$product->name}}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Combinations</li>
            </ol>
        </nav>

    @include('includes.messages')

    <!-- Content Row -->
        <div class="row">
            <div class="container-fluid">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="float-left">Combinations</h5>
                        <a href="/products/create" class="btn btn-outline-primary float-right"><i class="fas fa-plus"></i> Add Product</a>
                        <div class="clearfix"></div>
                    </div>

                    <div class="card-body mt-2">
                        @if ($product->attributeCombinations->isEmpty())
                            <p> There are no combinations yet.</p>
                        @else
                            {{--{{$products->links()}}--}}
                            <div class="table-responsive">
                                <table class="table table-hover text-center">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        @foreach($product->attributes as $attribute)
{{--                                            @if($attribute->name != "Print, Run and Delivery")--}}
                                                <th>{{$attribute->name}}</th>
                                            {{--@endif--}}
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($product->attributeCombinations as $attributeCombination)
                                            <tr>
                                                <td><a href="/combinations/{{$attributeCombination->id}}">{{$attributeCombination->id}}</a></td>
                                                @foreach(explode(",",$attributeCombination->attribute_value_ids) as $id)
                                                    <td>{{\App\Http\Controllers\CombinationController::findById($id)->value}}</td>
                                                @endforeach
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