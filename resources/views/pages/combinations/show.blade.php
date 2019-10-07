@extends('layouts.main')

@section('content')

    {{-- Right Content --}}
    <div class="body-right">
        <div class="container-fluid mb-5">
            <h1 class="h2 mb-0 text-gray-800">Combination Details</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="/flyerproducts/products">Products</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="/flyerproducts/products/{{$attributeCombination->product->entity_id}}">{{$attributeCombination->product->sku}}</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="/flyerproducts/combinations?id={{$attributeCombination->product->entity_id}}">Combinations</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Details</li>
                </ol>
            </nav>

            @include('includes.messages')

            <div class="container-fluid mt-5 col-12">
                <div class="card shadow mb-4">
                    <div class="card-header">Combination Details</div>
                    <input type="hidden" id="parentCombinationID" value="{{$attributeCombination->id}}">

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

                            <div class="table-responsive col-md-8 col-lg-5">
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

                        {{--<div class="form-group row">--}}
                            {{--<label for="type" class="col-md-12 col-form-label text-md-left">--}}
                                {{--<b>{{ __('Combination Type: ') }}--}}
                                    {{--@if($attributeCombination->parent == 0 && count($childs) > 0) Parent with child/s--}}
                                    {{--@elseif($attributeCombination->parent == 0 && count($childs) == 0) Parent without child--}}
                                    {{--@else Child--}}
                                    {{--@endif--}}
                                {{--</b>--}}
                            {{--</label>--}}
                        {{--</div>--}}

                        @if($attributeCombination->parent == 0 && count($childs) > 0)
                            <div class="form-group row" id="childs-holder">
                                <label for="value" class="col-md-12 col-form-label text-md-left"><b>{{ __('Childs') }}</b></label>

                                <div class="table-responsive">
                                    <table class="table table-hover text-center" id="childs">
                                        <thead>
                                            <tr>
                                                {{--<th>ID</th>--}}
                                                @foreach($attributeCombination->product->attributes as $attribute)
                                                    @if($attribute->name != "Print, Run and Delivery")
                                                        <th>{{$attribute->name}}</th>
                                                    @endif
                                                @endforeach
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="childs-body">
                                            @foreach($childs as $child)
                                                <tr id="{{$child->id}}">
                                                    {{--<td><a href="/combinations/{{$attributeCombination->id}}">{{$attributeCombination->id}}</a></td>--}}
                                                    <td class="d-none"><input type="hidden" value="{{$child->id}}"></td>
                                                    @foreach(explode(",",$child->attribute_value_ids) as $id)
                                                        <td>{{\App\Http\Controllers\CombinationController::findAttributeValueById($id)->value}}</td>
                                                    @endforeach
                                                    <td>
                                                        <button type="button" class="split-modal btn btn-outline-warning"><i class="fa fa-exclamation-triangle"></i> Split</button>
                                                        <button type="button" class="delete-modal btn btn-outline-danger"><i class="fa fa-trash"></i> Delete</button>
                                                    </td>
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
                                    <a href="/flyerproducts/combinations/{{$attributeCombination->id}}/edit?ids+{{$attributeCombination->attribute_value_ids}}" class="btn btn-outline-primary"><i class="fa fa-pencil-alt"></i> Modify</a>

                                    <button id="show-modal" type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#copy-form">
                                        <i class="fa fa-copy"></i> Copy Prices
                                    </button>

                                    @if(count($childs) == 0)
                                        <button type="button" class="delete-main-modal btn btn-outline-danger"><i class="fa fa-trash"></i> Delete</button>
                                    @endif


                                @else
                                    <a href="/flyerproducts/combinations/{{$attributeCombination->parent}}" class="btn btn-outline-primary"><i class="fa fa-eye"></i> See Parent</a>
                                    <a href="/flyerproducts/combinations/{{$attributeCombination->parent}}/edit?ids+{{\App\Http\Controllers\CombinationController::findAttributeCombinationById($attributeCombination->parent)->attribute_value_ids}}"
                                       class="btn btn-outline-primary"><i class="fa fa-pencil-alt"></i> Modify Parent
                                    </a>
                                    <button type="button" class="split-modal-single btn btn-outline-warning"><i class="fa fa-exclamation-triangle"></i> Split</button>
                                    <button type="button" class="delete-main-modal btn btn-outline-danger"><i class="fa fa-trash"></i> Delete</button>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <!-- COPY Modal -->
            <div class="modal fade" id="copy-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Copy Prices</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form id="copy">
                                @csrf

                                <input type="hidden" name="attributeCombinationID" value="{{$attributeCombination->id}}">
                                <input type="hidden" name="productID" value="{{$attributeCombination->product->entity_id}}">
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
                                        <button type="submit" class="btn btn-outline-primary"><i class="fa fa-copy"></i> Copy</button>
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

            <!-- SPLIT Modal -->
            <div class="modal fade" id="split-holder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Split Combination</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="split-modal-body">
                            <div class="m-3 font-weight-bold">Do you really wish to split this combination from its parent?</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Nope</button>

                            <form id="split-form">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">Sure</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SPLIT SINGLE Modal -->
            <div class="modal fade" id="split-holder-single" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Split Combination</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="split-modal-body">
                            <div class="m-3 font-weight-bold">Do you really wish to split this combination from its parent?</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Nope</button>

                            <form action="{{ action('CombinationController@splitSingle') }}" method="POST">
                                @csrf
                                <input type="hidden" name="parentID" value="{{$attributeCombination->parent}}">
                                <input type="hidden" name="combinationID" value="{{$attributeCombination->id}}">
                                <button type="submit" class="btn btn-outline-danger">Sure</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DELETE Modal -->
            <div class="modal fade" id="delete-holder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Combination</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="delete-modal-body">
                            <div class="m-3 font-weight-bold">Do you really wish to delete this combination from its parent?</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Nope</button>

                            <form id="delete-form">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">Yes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DELETE MAIN Modal -->
            <div class="modal fade" id="delete-main-holder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Combination</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="delete-main-modal-body">
                            <div class="m-3 font-weight-bold">Do you really wish to delete this combination?</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Nope</button>

                            <form id="delete-main-form" method="POST" action="{{ action('CombinationController@destroy', $attributeCombination->id) }}">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-outline-danger">Yes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <a href="/flyerproducts/combinations?id={{$attributeCombination->product->entity_id}}" class="btn btn-outline-primary mt-3"><i class="fas fa-chevron-left"></i> Back</a>

        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#show-modal').click(function () {
                $('.alert-success').remove();
                $('.alert-danger').remove();
            });

            $('#split-modal').click(function () {
                $('.alert-success').remove();
                $('.alert-danger').remove();
            });

            $('#copy').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "/flyerproducts/combinations/copy",
                    data: $('#copy').serialize(),
                    success: function (response) {
                        $('.alerts').remove();
                        $('#copy-form').modal('hide');

                        if (response.success) {
                            $('#cue').before("<div class=\"alert alert-success alerts\">"+ response.message +"</div>");
                            let temp = "<tr id=\""+ response.id +"\">";
                            temp += "<td class=\"d-none\"><input type=\"hidden\" value=\""+ response.id +"\"></td>";
                            for (let i = 0; i < response.attributeValues.length; i++)
                                temp += "<td>"+ response.attributeValues[i].value +"</td>";

                            temp += "<td><button type=\"button\" class=\"split-modal btn btn-outline-warning\"><i class=\"fa fa-exclamation-triangle\"></i> Split</button>" +
                                "<button type=\"button\" class=\"delete-modal btn btn-outline-danger\"><i class=\"fa fa-trash\"></i> Delete</button></td></tr>";
                            $('#childs tr:last').after(temp);

                            location.reload();

                        } else $('#cue').before("<div class=\"alert alert-danger alerts\">"+ response.message +"</div>");

                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });

            $('.split-modal').click(function (e) {
                $('#split-table').remove();

                let children = $(this).closest('td').parent()[0].children;
                let table = "<table class=\"table table-hover text-center\" id=\"split-table\">";
                let thead = "<thead><tr>";
                let tbody = "<tbody><tr>";

                @foreach($attributeCombination->product->attributes as $attribute)
                    @if($attribute->name != "Print, Run and Delivery")
                        thead += "<th>{{$attribute->name}}</th>";
                    @endif
                @endforeach

                    thead += "</tr></thead>";

                for (let i = 0; i < children.length-2; i++)
                    tbody += "<td>"+ children[i+1].innerText +"</td>";

                tbody += "</tr></tbody>";
                table += thead + tbody + "</table>";

                $('#split-modal-body').append(table);
                $('#split-form').append("<input type=\"hidden\" name=\"parentCombinationID\" value=\""+$('#parentCombinationID').val()+"\">\n" +
                    "    <input type=\"hidden\" name=\"combinationID\" value=\""+ children[0].children[0].value +"\">");

                $('#split-holder').modal('show');

            });

            $('#split-form').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "/flyerproducts/combinations/split",
                    data: $('#split-form').serialize(),
                    success: function (response) {
                        $('.alerts').remove();
                        $('#split-holder').modal('hide');
                        $('#cue').before("<div class=\"alert alert-success alerts\">Split Successfully.</div>");
                        $('#'+response.combinationID).remove();
                        $(".alerts").fadeTo(5000, 500).slideUp(500, function() { $(".alerts").slideUp(500); });
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });

            $('.split-modal-single').click(function (e) {
                $('#split-holder-single').modal('show');
            });

            $('.delete-modal').click(function (e) {

                $('#delete-table').remove();

                let children = $(this).closest('td').parent()[0].children;
                let table = "<table class=\"table table-hover text-center\" id=\"delete-table\">";
                let thead = "<thead><tr>";
                let tbody = "<tbody><tr>";

                @foreach($attributeCombination->product->attributes as $attribute)
                        @if($attribute->name != "Print, Run and Delivery")
                    thead += "<th>{{$attribute->name}}</th>";
                @endif
                        @endforeach

                    thead += "</tr></thead>";

                for (let i = 0; i < children.length-2; i++)
                    tbody += "<td>"+ children[i+1].innerText +"</td>";

                tbody += "</tr></tbody>";
                table += thead + tbody + "</table>";

                $('#delete-modal-body').append(table);
                $('#delete-form').append("<input type=\"hidden\" name=\"combinationID\" value=\""+ children[0].children[0].value +"\">");

                $('#delete-holder').modal('show');
            });

            $('#delete-form').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "/flyerproducts/combinations/delete",
                    data: $('#delete-form').serialize(),
                    success: function (response) {
                        $('.alerts').remove();
                        $('#delete-holder').modal('hide');
                        $('#cue').before("<div class=\"alert alert-success alerts\">Deleted Combination Successfully.\n" +
                            "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a></div>");
                        $('#'+response.combinationID).remove();
                        $(".alerts").fadeTo(5000, 500).slideUp(500, function() { $(".alerts").slideUp(500); });
                    },
                    error: function (error) {
                        console.log(error);
                        $('.alerts').remove();
                        $('#delete-holder').modal('hide');
                        $('#cue').before("<div class=\"alert alert-danger alerts\">Deleted Combination Unsuccessfully.\n" +
                            "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a></div>");
                        $(".alerts").fadeTo(5000, 500).slideUp(500, function() { $(".alerts").slideUp(500); });
                    }
                });
            });

            $('.delete-main-modal').click(function (e) {
                $('#delete-main-holder').modal('show');
            });

        });
    </script>

@endsection
