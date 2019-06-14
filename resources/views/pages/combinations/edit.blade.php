@extends('layouts.main')

@section('content')

    {{-- Right Content --}}
    <div class="body-right">
        <div class="container-fluid mb-5">
            <h1 class="h2 mb-0 text-gray-800">Modify Combination</h1>
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
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="/combinations/{{$attributeCombination->id}}">Details</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Modify</li>
                </ol>
            </nav>

            @include('includes.messages')

            <div class="container-fluid mt-5 col-lg-6 col-sm-7">
                <div class="card shadow mb-4">
                    <div class="card-header">Modify Combination</div>

                    <div class="card-body">

                        <form action="{{ action('CombinationController@update', $attributeCombination->id) }}" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            @csrf
                            <input type="hidden" name="id" value="{{$attributeCombination->product->id}}">
                            <input type="hidden" name="ids" value="{{$ids}}">


                            <div class="form-group row">
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

                            <div class="form-group">
                                <label for="value" class="col-md-12 col-form-label text-md-left"><b>{{ __('Print, Run and Delivery') }} <span class="text-danger">*</span></b></label>

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="materialsTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Quantity<span class="text-danger">*</span></th>
                                            <th>Price/unit<span class="text-danger">*</span></th>
                                            <th>Del</th>
                                        </tr>
                                        </thead>
                                        <tbody id="materialsBody">
                                            @foreach($attributeCombination->prices as $price)
                                                <tr>
                                                    <td>
                                                        <input type="number" name="quantity[]" class="form-control" required="required" value="{{$price->quantity}}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="price[]" class="form-control" required="required" value="{{$price->price}}">
                                                    </td>
                                                    <td class="text-center"><i class="fa fa-trash del-btn" onclick="deleteRow(this)" style="cursor: pointer;"></i></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <button type="button" class="ml-3 btn btn-outline-primary mt-5" onclick="addRow()"><i class="fas fa-plus"></i> Add new row</button>
                            </div>

                            <div class="form-group mt-5 text-center">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-outline-primary"><i class="fa fa-check"></i> Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <a href="/combinations/{{$attributeCombination->id}}" class="btn btn-outline-primary mt-3"><i class="fas fa-chevron-left"></i> Back</a>
        </div>
    </div>

    <script>
        function addRow() {
            // if (document.getElementsByClassName('select-class').length < totalMaterials ) {
            let td, tr;
            let tbody = document.getElementById("materialsBody");

            // for each outer array row
            tr = document.createElement("tr");

            td = document.createElement("td");
            let node_quantity = document.createElement("input");
            node_quantity.type = 'number';
            node_quantity.name = 'quantity[]';
            node_quantity.className = 'form-control';
            node_quantity.setAttribute("required", "required");
            td.appendChild(node_quantity);
            tr.appendChild(td);


            td = document.createElement("td");
            let node_price = document.createElement("input");
            node_price.type = 'number';
            node_price.name = 'price[]';
            node_price.className = 'form-control';
            node_price.setAttribute("required", "required");
            td.appendChild(node_price);
            tr.appendChild(td);

            td = document.createElement("td");
            let node_del = document.createElement("i");
            node_del.className = 'fa fa-trash del-btn';
            node_del.style = "cursor:pointer";
            node_del.setAttribute("onclick", "deleteRow(this)");
            td.setAttribute("class", "text-center");
            td.appendChild(node_del);
            tr.appendChild(td);

            tbody.appendChild(tr);
            // }
        }

        function deleteRow(r) {
            let i = (r.parentNode.parentNode.rowIndex);
            document.getElementById("materialsTable").deleteRow(i);
        }
    </script>

@endsection
