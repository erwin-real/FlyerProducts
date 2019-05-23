@extends('layouts.main')

@section('content')

    {{-- Right Content --}}
    <div class="body-right">
        <div class="container-fluid">
            <h1 class="h2 mb-0 text-gray-800">Update Product</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="/">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="/products">Products</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="/products/{{$product->id}}">{{$product->name}}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Update Product info & attributes</li>
                </ol>
            </nav>

            @include('includes.messages')

            <div class="container-fluid mt-5 col-lg-6 col-sm-7">
                <div class="card shadow mb-4">
                    <div class="card-header">{{ __('Product\'s Information') }}</div>

                    <div class="card-body">

                        <form action="{{ action('ProductController@update', $product->id) }}" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-12 col-form-label text-md-left">{{ __('Product Name') }} <span class="text-danger">*</span></label>

                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$product->name}}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="details" class="col-md-12 col-form-label text-md-left">{{ __('Product\'s Details') }} <span class="text-danger">*</span></label>

                                <div class="col-md-12">
                                    <input id="details" type="text" class="form-control{{ $errors->has('details') ? ' is-invalid' : '' }}" name="details" value="{{$product->details}}" required autofocus>

                                    @if ($errors->has('details'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('details') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="attrib[]" class="col-md-12 col-form-label text-md-left">{{ __('Product\'s Attributes') }} <span class="text-danger">*</span></label>

                                <div class="col-md-12">

                                    <ol id="attributes">
                                        @foreach($product->attributes as $attribute)
                                            @if($attribute->name != "Print, Run and Delivery")
                                                <li><input id="attrib[]" type="text" name="attribute[]" value="{{$attribute->name}}" required></li>
                                                {{--<li><input type="text" name="attribute[]" value="{{$attribute->name}}"> <span class="text-danger" style="cursor: pointer;" onclick="deleteItem(this)">x</span></li>--}}
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

                            <div class="form-group row mb-0 text-center">
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

            let node_value = document.createElement("input");
            node_value.type = 'text';
            node_value.name = 'attribute[]';
            node_value.setAttribute("required", "required");
            newItem.appendChild(node_value);

            let list = document.getElementById("attributes");
            list.insertBefore(newItem, list.childNodes[list.childNodes.length-1]);
        }

        function deleteItem(r) {
            // console.log(document.getElementById("attributes").getElementsByTagName("li").length - 1);
            let lists = document.getElementById("attributes").getElementsByTagName("li");
            let value = r.parentNode.childNodes[0].value;

            for (let i = 0; i < lists.length - 1; i++) {
                console.log(lists);
            }

            // let i = (r.parentNode.parentNode.rowIndex);
            // document.getElementById("materialsTable").deleteRow(i);
        }

    </script>
@endsection
