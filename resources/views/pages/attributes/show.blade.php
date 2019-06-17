@extends('layouts.main')

@section('content')

    <div class="container-fluid mb-5">

        <!-- Page Heading -->
        <h1 class="h2 mb-0 text-gray-800">Attribute Value ID {{$attributeValue->id}}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page">
                    <a href="/products">Products</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="/products/{{$attributeValue->attribute->product->id}}">{{$attributeValue->attribute->product->name}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="/attributes?id={{$attributeValue->attribute->id}}">Attribute: {{$attributeValue->attribute->name}}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{$attributeValue->id}}</li>
            </ol>
        </nav>

    @include('includes.messages')

    <!-- Content Row -->

        <div class="mt-5 col-lg-7 col-sm-8">
            <div class="card shadow">
                <div class="card-header ">
                    <h5>Attribute Value's Information</h5>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left"><b>{{ __('Attribute Value') }}</b></label>

                        <div class="offset-1 col-10">
                            <span id="name">{{$attributeValue->value}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left"><b>{{ __('Attribute\'s Details') }}</b></label>

                        <div class="offset-1 col-10">
                            <span id="name">{{$attributeValue->details}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left"><b>{{ __('Attribute\'s Image') }}</b></label>

                        <div class="offset-1 col-10">
                            <span id="name">
                                <img src="/storage/imagepaths/{{$attributeValue->imagepath}}" alt="" style="width: 100%;" />
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left"><b>{{ __('Actions') }}</b></label>


                        <div class="offset-1 col-10">
                            <a href="/attributes/{{$attributeValue->id}}/edit" class="btn btn-outline-primary mt-3"><i class="fa fa-pencil-alt"></i> Update</a><br />
                        </div>
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


    </div>

@endsection