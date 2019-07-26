@extends('layouts.main')

@section('content')

    {{-- Right Content --}}
    <div class="body-right">
        <div class="container-fluid mb-5">
            <h1 class="h2 mb-0 text-gray-800">Update Product</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="/flyerproducts/products">Products</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="/flyerproducts/products/{{$product->entity_id}}">{{$product->sku}}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Update Product info & attributes</li>
                </ol>
            </nav>

            <div class="alert alert-danger">
                If you change the Product's Attributes, all of the Attribute Values and Product Combinations will be lost.
            </div>

            @include('includes.messages')

            <div class="container-fluid mt-5 col-lg-6 col-sm-7">
                <div class="card shadow mb-4">
                    <div class="card-header">{{ __('Product\'s Information') }}</div>

                    <div class="card-body">

                        <form action="{{ action('ProductController@update', $product->entity_id) }}" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-12 col-form-label text-md-left">{{ __('Product Name') }} <span class="text-danger">*</span></label>

                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$product->sku}}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--<div class="form-group row">--}}
                                {{--<label for="details" class="col-md-12 col-form-label text-md-left">Product Details <span class="text-danger">*</span></label>--}}

                                {{--<div class="col-md-12">--}}
                                    {{--<textarea class="form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" rows="3" id="details" name="details" autofocus>{{$product->details}}</textarea>--}}
                                    {{--@if ($errors->has('details'))--}}
                                        {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('details') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group row">
                                <label for="attributes[]" class="col-md-12 col-form-label text-md-left">{{ __('Product\'s Attributes') }} <span class="text-danger">*</span></label>

                                <div class="col-md-12">

                                    <ol id="attributes">
                                        @foreach($product->attributes as $attribute)
                                            @if($attribute->name != "Print, Run and Delivery")
                                                <li><input id="attributes[]" type="text" name="attribute[]" value="{{$attribute->name}}" required><span class="text-danger" style="cursor: pointer;" onclick="deleteItem(this)"> x</span></li>
                                                {{--<li><input type="text" name="attribute[]" value="{{$attribute->name}}"></li>--}}
                                            @endif
                                        @endforeach
                                        <li><input type="hidden" name="attribute[]" value="Print, Run and Delivery">Print, Run and Delivery</li>
                                    </ol>

                                    @if ($errors->has('attributes'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('attributes') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <button type="button" class="ml-3 btn btn-outline-primary" onclick="append()"><i class="fa fa-plus"></i> Add Attribute</button>

                            <div class="form-group row mb-0 mt-4 text-center">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-outline-primary">
                                        <i class="fa fa-check"></i> {{ __('Save') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function append() {
            let newItem = document.createElement("li");

            let input = document.createElement("input");
            input.id='attributes[]';
            input.type = 'text';
            input.name = 'attribute[]';
            input.setAttribute("required", "required");
            newItem.appendChild(input);

            let span = document.createElement("span");
            span.style = 'cursor: pointer; color: #e74a3b;';
            span.setAttribute("onclick","deleteItem(this)");
            span.innerHTML = " x";
            newItem.appendChild(span);

            let list = document.getElementById("attributes");
            list.insertBefore(newItem, list.childNodes[list.childNodes.length-2]);
        }

        function deleteItem(r) {
            document.getElementById("attributes").removeChild(r.parentNode);
        }

    </script>
@endsection
