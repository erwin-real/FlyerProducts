@extends('layouts.main')

@section('content')

    <div class="container-fluid mb-5">

        <!-- Page Heading -->
        <h1 class="h2 mb-0 text-gray-800">Combination {{$attributeCombination->id}}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page">
                    <a href="/products">Products</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="/products/{{$attributeCombination->product->id}}">{{$attributeCombination->product->name}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="/combinations?id={{$attributeCombination->product->id}}">Combinations</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Combination {{$attributeCombination->id}}</li>
            </ol>
        </nav>

    @include('includes.messages')


        <div class="mt-5 col-lg-7 col-sm-8">
            <div class="card shadow">
                <div class="card-header ">
                    <h5>Combination's Information</h5>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left"><b>{{ __('Product Name') }}</b></label>

                        <div class="offset-1 col-10">
                            <span id="name">{{$attributeCombination->product->name}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left"><b>{{ __('Product\'s Details') }}</b></label>

                        <div class="offset-1 col-10">
                            <span id="name">{{$attributeCombination->product->details}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left"><b>{{ __('Attributes') }}</b></label>

                        <div class="offset-1 col-10">
                            <ol>
                                {{--@foreach($product->attributes as $attribute)--}}
                                    {{--@if($attribute->name != "Print, Run and Delivery")--}}
                                        {{--<li><a href="/attributes/{{$attribute->id}}">{{$attribute->name}}</a></li>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                                {{--@if(count($product->attributes) > 0 && count($product->attributes[0]->attributeValues) > 0 )--}}
                                    {{--<li><a href="/combinations/create?id={{$product->id}}">Print, Run and Delivery</a></li>--}}
                                {{--@else--}}
                                    {{--<li>Print, Run and Delivery</li>--}}
                                {{--@endif--}}
                            </ol>
                        </div>
                    </div>

                    <div class="w-100 text-center">
                        <a href="/combinations?id={{$attributeCombination->product->id}}" class="btn btn-outline-primary"><i class="fa fa-pencil-alt"></i> Combinations</a><br />
                        {{--<a href="{{ action('CombinationController@index', $product) }}" class="btn btn-outline-primary"><i class="fa fa-pencil-alt"></i> Combinations</a><br />--}}
                        <a href="{{ action('ProductController@edit', $attributeCombination->product->id) }}" class="btn btn-outline-info mt-3"><i class="fa fa-pencil-alt"></i> Update Product info & attributes</a>
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
        <a href="/combinations?id={{$attributeCombination->id}}" class="btn btn-outline-primary mt-3"><i class="fas fa-chevron-left"></i> Back</a>


    </div>

@endsection