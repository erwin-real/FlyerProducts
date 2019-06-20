@extends('layouts.main')

@section('content')

    <div class="container-fluid mb-5">

        <!-- Page Heading -->
        <h1 class="h2 mb-0 text-gray-800">Attribute: {{$attribute->name}}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page">
                    <a href="/flyerproducts/public/products">Products</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="/flyerproducts/public/products/{{$attribute->product->id}}">{{$attribute->product->name}}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Attribute: {{$attribute->name}}</li>
            </ol>
        </nav>

    @include('includes.messages')

    <!-- Content Row -->
        <div class="row">
            <div class="container-fluid">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="float-left">Attribute Values</h5>
                        <a href="/flyerproducts/public/attributes/create?id={{$attribute->id}}" class="btn btn-outline-primary float-right"><i class="fas fa-plus"></i> Add Value</a>
                        <div class="clearfix"></div>
                    </div>

                    <div class="card-body mt-2">
                        @if ($attribute->attributeValues->isEmpty())
                            <p> There are no attribute values yet.</p>
                        @else
                            {{--{{$attribute->products->links()}}--}}
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Value</th>
                                        <th>Details</th>
                                        <th>Image Path</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($attribute->attributeValues as $attributeValue)
                                        <tr>
                                            <td class="align-middle"><a href="/flyerproducts/public/attributes/{{$attributeValue->id}}">{{ $attributeValue->id }}</a></td>
                                            <td class="align-middle">{{ $attributeValue->value }}</td>
                                            <td class="align-middle">{{ $attributeValue->details }}</td>
                                            <td class="align-middle">
                                                <img src="/flyerproducts/public/storage/imagepaths/{{$attributeValue->imagepath}}" alt="" style="width: 100%;" />
                                            </td>
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