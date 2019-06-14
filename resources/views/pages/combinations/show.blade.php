@extends('layouts.main')

@section('content')

    {{-- Right Content --}}
    <div class="body-right">
        <div class="container-fluid mb-5">
            <h1 class="h2 mb-0 text-gray-800">Combination Details</h1>
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
                    <li class="breadcrumb-item active" aria-current="page">Details</li>
                </ol>
            </nav>

            @include('includes.messages')

            <div class="container-fluid mt-5 col-lg-6 col-sm-7">
                <div class="card shadow mb-4">
                    <div class="card-header">Combination Details</div>

                    <div class="card-body">

                        <div id="cue" class="form-group row">
                            <label for="name" class="col-md-12 col-form-label text-md-left"><b>{{ __('Combinations') }}</b></label>

                            <div class="offset-1 col-10">
                                <ol>
                                    @foreach(explode(",",$attributeCombination->attribute_value_ids) as $id)
                                        <li>
                                            <span class="font-weight-bold">{{\App\Http\Controllers\CombinationController::findAttributeValueById($id)->attribute->name}}</span><br />
                                            <span class="ml-3">{{\App\Http\Controllers\CombinationController::findAttributeValueById($id)->value}}</span><br /><br />
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="value" class="col-md-12 col-form-label text-md-left"><b>{{ __('Print, Run and Delivery') }}</b></label>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="materialsTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Quantity</th>
                                        <th>Price/unit</th>
                                    </tr>
                                    </thead>
                                    <tbody id="materialsBody">
                                    @if($attributeCombination->parent == 0)
                                        @foreach($attributeCombination->prices as $price)
                                            <tr>
                                                <td>{{$price->quantity}}</td>
                                                <td>{{$price->price}}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        @foreach(\App\Http\Controllers\CombinationController::findAttributeCombinationById($attributeCombination->parent)->prices as $price)
                                            <tr>
                                                <td>{{$price->quantity}}</td>
                                                <td>{{$price->price}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        @if($attributeCombination->parent == 0)
                            <div class="form-group row">
                                <label for="value" class="col-md-12 col-form-label text-md-left"><b>{{ __('Childs') }}</b></label>

                                <div class="table-responsive">
                                    <table class="table table-hover text-center">
                                        <thead>
                                        <tr>
                                            {{--<th>ID</th>--}}
                                            @foreach($attributeCombination->product->attributes as $attribute)
                                                @if($attribute->name != "Print, Run and Delivery")
                                                    <th>{{$attribute->name}}</th>
                                                @endif
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($childs as $child)
                                            <tr>
                                                {{--<td><a href="/combinations/{{$attributeCombination->id}}">{{$attributeCombination->id}}</a></td>--}}
                                                @foreach(explode(",",$child->attribute_value_ids) as $id)
                                                    <td>{{\App\Http\Controllers\CombinationController::findAttributeValueById($id)->value}}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif

                        <div class="form-group row">
                            <label for="action" class="col-md-12 col-form-label text-md-left"><b>{{ __('Actions') }}</b></label>
                            <div class="offset-1 col-10">

                                @if($attributeCombination->parent == 0)
                                    <a href="/combinations/{{$attributeCombination->id}}/edit?ids+{{$attributeCombination->attribute_value_ids}}" class="btn btn-outline-primary"><i class="fa fa-pencil-alt"></i> Modify</a>

                                    <button id="show-modal" type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#copy-form">
                                        <i class="fa fa-copy"></i> Copy Prices
                                    </button>
                                @else
                                    <a href="/combinations/{{$attributeCombination->parent}}" class="btn btn-outline-primary"><i class="fa fa-eye"></i> See Parent</a>
                                    <a href="/combinations/{{$attributeCombination->parent}}/edit?ids+{{\App\Http\Controllers\CombinationController::findAttributeCombinationById($attributeCombination->parent)->attribute_value_ids}}"
                                       class="btn btn-outline-primary"><i class="fa fa-pencil-alt"></i> Modify Parent</a>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="copy-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form id="copy">
                                @csrf

                                <input type="hidden" name="attributeCombinationID" value="{{$attributeCombination->id}}">
                                <input type="hidden" name="productID" value="{{$attributeCombination->product->id}}">
                                @foreach($attributeCombination->product->attributes as $attribute)
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
                                        <button type="submit" class="btn btn-outline-primary"><i class="fa fa-eye"></i> Copy</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <a href="/combinations?id={{$attributeCombination->product->id}}" class="btn btn-outline-primary mt-3"><i class="fas fa-chevron-left"></i> Back</a>

        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#show-modal').click(function (e) {
                $('.alert-success').remove();
                $('.alert-danger').remove();
            });

            $('#copy').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "/combinations/copy",
                    data: $('#copy').serialize(),
                    success: function (response) {
                        $('#copy-form').modal('hide');

                        if (response.success) $('#cue').before("<div class=\"alert alert-success\">"+ response.message +"</div>");
                        else $('#cue').before("<div class=\"alert alert-danger\">"+ response.message +"</div>");



                        {{--$('#action-holder').remove();--}}

                        {{--$('#show').after(--}}
                            {{--"<div id=\"action-holder\" class=\"form-group row\">" +--}}
                            {{--"<label for=\"action\" class=\"col-md-12 col-form-label text-md-left\"><b>Action</b></label>" +--}}
                            {{--"<div id=\"action\" class=\"offset-1 col-10\">" +--}}
                            {{--"</div>" +--}}
                            {{--"</div>"--}}
                        {{--);--}}

                        {{--if (response.attributeCombinationID != null)--}}
                            {{--$('#action').append("<a href=\"/combinations/"+ response.attributeCombinationID +"\" class=\"btn btn-outline-primary\"><i class=\"fa fa-eye\"></i> See Prices</a>");--}}
                        {{--else--}}
                            {{--$('#action').append("<a href=\"/combinations/create?ids="+response.combination+"&id={{$product->id}}\" class=\"btn btn-outline-primary\"><i class=\"fa fa-plus\"></i> Create</a>")--}}
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>

@endsection
