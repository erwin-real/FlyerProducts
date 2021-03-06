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
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="/flyerproducts/products/{{$product->entity_id}}">{{$product->sku}}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Combinations</li>
                </ol>
            </nav>

            @include('includes.messages')

            <div class="mt-5 col-lg-7 col-sm-8">
                <div class="card shadow">
                    <div class="card-header ">
                        <h5>Product's Combinations</h5>
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
                        </div>

                        {{--<form action="/combinations/evaluate" method="POST">--}}
                        <form id="show">
                            @csrf
                            <input type="hidden" name="id" value="{{$product->entity_id}}">

                            @foreach($product->attributes as $attribute)
                                @if($attribute->name != "Print, Run and Delivery")
                                    <div class="form-group">
                                        <label for="value" class="col-lg-12 control-label">{{$attribute->name}} <span class="text-danger">*</span></label>
                                        <div class="col-lg-12">
                                            <select id="value" name="combinations[]" class="form-control" required autofocus>
                                                @foreach($attribute->attributeValues as $attributeValue)
                                                    <option value="{{$attributeValue->id}}">{{$attributeValue->value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                            <div class="form-group mt-5 text-center">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-outline-primary"><i class="fa fa-eye"></i> Show</button>
                                </div>
                            </div>
                        </form>

                        <div class="clearfix"></div>
                    </div>

                </div>

            </div>
            <a href="/flyerproducts/products/{{$product->entity_id}}" class="btn btn-outline-primary mt-3"><i class="fas fa-chevron-left"></i> Back</a>
        </div>
    </div>

    <script>
        $(document).ready(function () {

            $('select').on('change', function() {
                $('#action-holder').remove();
            });

            $('#show').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "/flyerproducts/combinations/evaluate",
                    data: $('#show').serialize(),
                    success: function (response) {
                        $('#action-holder').remove();

                        $('#show').after(
                            "<div id=\"action-holder\" class=\"form-group row\">" +
                                "<label for=\"action\" class=\"col-md-12 col-form-label text-md-left\"><b>Action</b></label>" +
                                "<div id=\"action\" class=\"offset-1 col-10\">" +
                                "</div>" +
                            "</div>"
                        );

                        if (response.attributeCombinationID != null)
                            $('#action').append("<a href=\"/flyerproducts/combinations/"+ response.attributeCombinationID +"\" class=\"btn btn-outline-primary\"><i class=\"fa fa-eye\"></i> See Prices and Details</a>");
                            // $('#action').append("<a href=\"/combinations/"+ response.attributeCombinationID +"/edit?ids="+response.combination+"\" class=\"btn btn-outline-primary\"><i class=\"fa fa-eye\"></i> See Prices</a>");
                        else
                            $('#action').append("<a href=\"/flyerproducts/combinations/create?ids="+response.combination+"&id={{$product->entity_id}}\" class=\"btn btn-outline-primary\"><i class=\"fa fa-plus\"></i> Create</a>")
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>

@endsection