@extends('layouts.main')

@section('content')

    {{-- Right Content --}}
    <div class="body-right">
        <div class="container-fluid mb-5">
            <h1 class="h2 mb-0 text-gray-800">{{$product->name}}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="/flyerproducts/public/products">Products</a>
                    </li>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="/flyerproducts/public/products/{{$product->id}}">{{$product->name}}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Combinations</li>
                </ol>
            </nav>

            @include('includes.messages')

            <div class="mt-5 col-lg-7 col-sm-8">
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Product's Combinations</h5>
                        <div class="clearfix"></div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-12 col-form-label text-md-left"><b>{{ __('Product Name') }}</b></label>

                            <div class="offset-1 col-10">
                                <span id="name">{{$product->name}}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-12 col-form-label text-md-left"><b>{{ __('Product\'s Details') }}</b></label>

                            <div class="offset-1 col-10">
                                <span id="name">{{$product->details}}</span>
                            </div>
                        </div>

                        <div class="form-group row m-0">
                            <label for="name" class="col-md-12 col-form-label text-md-left"><b>{{ __('Combinations') }}</b></label>

                            <div class="offset-1 col-10">
                                <ol class="m-0">
                                    @foreach($attributeValues as $attributeValue)
                                        <li>
                                            <span class="font-weight-bold">{{$attributeValue->attribute->name}}</span><br />
                                            <span class="ml-3">{{$attributeValue->value}}</span><br /><br />
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>

                        @if($attributeCombination != null)
                            <div class="form-group row">
                                <label for="name" class="col-md-12 col-form-label text-md-left"><b>{{ __('Print, Run & Delivery') }}</b></label>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($attributeCombination->prices as $price)
                                                <tr>
                                                    <td>{{$price->quantity}}</td>
                                                    <td>{{$price->price}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="form-group row">
                            <label for="action" class="col-md-12 col-form-label text-md-left"><b>{{ __('Action') }}</b></label>

                            <div class="offset-1 col-10">
                                @if($attributeCombination != null)
                                    <div class="offset-1 col-10">
                                        <a href="/flyerproducts/public/combinations/{{$attributeCombination->id}}/edit?ids={{$combination}}" class="btn btn-outline-primary"><i class="fa fa-pencil-alt"></i> Modify</a>
                                    </div>
                                @else
                                    <div class="offset-1 col-10">
                                        <a href="/flyerproducts/public/combinations/create?ids={{$combination}}&id={{$product->id}}" class="btn btn-outline-primary"><i class="fa fa-plus"></i> Create</a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>

                </div>

            </div>
            <a href="/flyerproducts/public/products" class="btn btn-outline-primary mt-3"><i class="fas fa-chevron-left"></i> Back</a>
        </div>
    </div>

    {{--MODAL--}}
    {{--<div class="modal fade" id="delUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
    {{--<div class="modal-dialog" role="document">--}}
    {{--<div class="modal-content">--}}
    {{--<div class="modal-header">--}}
    {{--<h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this product?</h5>--}}
    {{--<button class="close" type="button" data-dismiss="modal" aria-label="Close">--}}
    {{--<span aria-hidden="true">×</span>--}}
    {{--</button>--}}
    {{--</div>--}}
    {{--<div class="modal-body">Select "Delete" below if you are sure on deleting this product.</div>--}}
    {{--<div class="modal-footer">--}}
    {{--<button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>--}}

    {{--<form id="delete" method="POST" action="{{ action('ProductController@destroy', $product->id) }}" class="float-left">--}}
    {{--<input type="hidden" name="_method" value="DELETE">--}}
    {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
    {{--<div>--}}
    {{--<button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash"></i> Delete</button>--}}
    {{--</div>--}}
    {{--</form>--}}

    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

@endsection