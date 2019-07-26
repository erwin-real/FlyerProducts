@extends('layouts.main')

@section('content')

    {{-- Right Content --}}
    <div class="body-right">
        <div class="container-fluid mb-5">
            <h1 class="h2 mb-0 text-gray-800">{{$product->sku}}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="/flyerproducts/products">Products</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{$product->sku}}</li>
                </ol>
            </nav>

            @include('includes.messages')

            <div class="mt-5 col-lg-7 col-sm-8">
                <div class="card shadow">
                    <div class="card-header ">
                        <h5>Product's Information</h5>
                        <div class="clearfix"></div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-12 col-form-label text-md-left"><b>{{ __('Product Name') }}</b></label>

                            <div class="offset-1 col-10">
                                <span id="name">{{$product->sku}}</span>
                            </div>
                        </div>

                        {{--<div class="form-group row">--}}
                            {{--<label for="name" class="col-md-12 col-form-label text-md-left"><b>{{ __('Product\'s Details') }}</b></label>--}}

                            {{--<div class="offset-1 col-10">--}}
                                {{--<span id="name">{{$product->details}}</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="form-group row">
                            <label for="name" class="col-md-12 col-form-label text-md-left"><b>{{ __('Attributes') }}</b></label>

                            <div class="offset-1 col-10">
                                <ol>
                                    @foreach($product->attributes as $attribute)
                                        @if($attribute->name != "Print, Run and Delivery")
                                            <li><a href="/flyerproducts/attributes?id={{$attribute->id}}">{{$attribute->name}}</a></li>
                                            {{--<li><a href="/attributes/{{$attribute->id}}">{{$attribute->name}}</a></li>--}}
                                        @endif
                                    @endforeach
                                    <li>Print, Run and Delivery</li>
                                </ol>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-12 col-form-label text-md-left"><b>{{ __('Date Added') }}</b></label>

                            <div class="offset-1 col-10">
                                <span>{{ date('D M d, Y h:i a', strtotime($product->created_at)) }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-12 col-form-label text-md-left"><b>{{ __('Date Modified') }}</b></label>

                            <div class="offset-1 col-10">
                                <span>{{ date('D M d, Y h:i a', strtotime($product->updated_at)) }}</span>
                            </div>
                        </div>

                        <div class="w-100 text-center">
{{--                            <a href="/combinations/all?id={{$product->entity_id}}" class="btn btn-outline-primary"><i class="fa fa-pencil-alt"></i> Combinations</a><br />--}}
                            <a href="/flyerproducts/combinations?id={{$product->entity_id}}" class="btn btn-outline-primary mt-3"><i class="fa fa-pencil-alt"></i> Combinations</a><br />
                            {{--<a href="{{ action('CombinationController@index', $product) }}" class="btn btn-outline-primary"><i class="fa fa-pencil-alt"></i> Combinations</a><br />--}}
                            <a href="{{ action('ProductController@edit', $product->entity_id) }}" class="btn btn-outline-info mt-3"><i class="fa fa-pencil-alt"></i> Update Product info & attributes</a>
                        </div>

                        {{--DELETE BUTTON--}}
                        {{--<button class="btn btn-outline-danger" data-toggle="modal" data-target="#delUserModal">--}}
                        {{--<i class="fas fa-trash fa-sm fa-fw"></i>--}}
                        {{--Delete--}}
                        {{--</button>--}}
                        <div class="clearfix"></div>
                    </div>

                </div>

            </div>
            <a href="/flyerproducts/products" class="btn btn-outline-primary mt-3"><i class="fas fa-chevron-left"></i> Back</a>
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

    {{--<form id="delete" method="POST" action="{{ action('ProductController@destroy', $product->entity_id) }}" class="float-left">--}}
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