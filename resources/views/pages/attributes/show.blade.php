@extends('layouts.main')

@section('content')

    <div class="container-fluid mb-5">

        <!-- Page Heading -->
        <h1 class="h2 mb-0 text-gray-800">Attribute Value ID {{$attributeValue->id}}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page">
                    <a href="/flyerproducts/products">Products</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="/flyerproducts/products/{{$attributeValue->attribute->product->entity_id}}">{{$attributeValue->attribute->product->sku}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="/flyerproducts/attributes?id={{$attributeValue->attribute->id}}">Attribute: {{$attributeValue->attribute->name}}</a>
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
                                <img src="/flyerproducts/storage/imagepaths/{{$attributeValue->imagepath}}" alt="" style="width: 100px;" />
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label text-md-left"><b>{{ __('Actions') }}</b></label>

                        <div class="offset-1 col-10">
                            <a href="/flyerproducts/attributes/{{$attributeValue->id}}/edit" class="btn btn-outline-primary"><i class="fa fa-pencil-alt"></i> Update</a>
                            {{--DELETE BUTTON--}}
                            <button class="btn btn-outline-danger" data-toggle="modal" data-target="#delUserModal">
                                <i class="fas fa-trash fa-sm fa-fw"></i>
                                Delete
                            </button>
                            <br>

                            {{--@if(session('success') == "Added New Attribute Value Successfully!")--}}
                                {{--<a href="/flyerproducts/attributes/create?id={{$attributeValue->attribute->id}}" class="btn btn-outline-success mt-2"><i class="fa fa-plus"></i>--}}
                                    {{--Add more attribute value for attribute {{$attributeValue->attribute->name}}--}}
                                {{--</a>--}}
                            {{--@endif--}}
                        </div>

                    </div>


                    <!-- DELETE Modal-->
                    <div class="modal fade" id="delUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Attribute?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">Are you sure you want to delete this attribute?</div>
                                <div class="modal-footer">
                                    <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>

                                    <form action="{{ action('AttributeController@destroy', $attributeValue->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>

            </div>

        </div>


    </div>

@endsection