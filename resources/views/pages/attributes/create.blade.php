@extends('layouts.main')

@section('content')

    {{-- Right Content --}}
    <div class="body-right">
        <div class="container-fluid mb-5">
            <h1 class="h2 mb-0 text-gray-800">Add Attribute Value</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="/flyerproducts/public/products">Products</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="/flyerproducts/public/products/{{$attribute->product->id}}">{{$attribute->product->name}}</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="/flyerproducts/public/attributes?id={{$attribute->id}}">Attribute: {{$attribute->name}}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Attribute Value</li>
                </ol>
            </nav>

            @include('includes.messages')

            <div class="container-fluid mt-5 col-lg-6 col-sm-7">
                <div class="card shadow mb-4">
                    <div class="card-header">Add Attribute Value</div>

                    <div class="card-body">

                        <form action="{{ action('AttributeController@store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$attribute->id}}">

                            <div class="form-group row">
                                <label for="value" class="col-md-12 col-form-label text-md-left">Attribute Value <span class="text-danger">*</span></label>

                                <div class="col-md-12">
                                    <input id="value" type="text" class="form-control{{ $errors->has('value') ? ' is-invalid' : '' }}" name="value" required autofocus>

                                    @if ($errors->has('value'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="details" class="col-md-12 col-form-label text-md-left">Attribute Value Details</label>

                                <div class="col-md-12">
                                    <textarea class="form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" rows="3" id="details" name="details" autofocus></textarea>
                                    @if ($errors->has('details'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('details') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="imagepath" class="col-md-12 col-form-label text-md-left">Attribute Value Image</label>

                                <div class="col-md-12">
                                    <input id="imagepath" type="file" class="form-control {{ $errors->has('imagepath') ? ' is-invalid' : '' }}" name="imagepath" autofocus>
                                    @if ($errors->has('imagepath'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('imagepath') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

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
@endsection
