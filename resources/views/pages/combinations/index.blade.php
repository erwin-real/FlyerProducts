@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="/products">Products</a> /
                    <a href="/products/{{$attribute->product->id}}">{{$attribute->product->name}}</a> /
                    Attribute {{$attribute->name}}
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card-body mt-2">
                        @if ($attribute->attributeValues->isEmpty())
                            <p> There are no attribute values yet.</p>
                        @else
                            {{--{{$products->links()}}--}}
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Value</th>
                                            <th>Details</th>
                                            <th>Image Path</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($attribute->attributeValues as $attributeValue)
                                        <tr>
                                            {{--<td><a href="/products/{{$product->id}}">{{$product->name}}</a></td>--}}
                                            <td>{{$attributeValue->value}}</td>
                                            <td>{{$attributeValue->details}}</td>
                                            <td>{{$attributeValue->imagepath}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                    <a href="/attributes/{{$attribute->id}}/create" class="btn btn-outline-success"><i class="fa fa-plus"></i> Add Value</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
