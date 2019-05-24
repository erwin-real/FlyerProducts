@extends('layouts.main')

@section('content')

    {{-- Right Content --}}
    <div class="body-right">
        <div class="container-fluid mb-5">
            <h1 class="h2 mb-0 text-gray-800">Print, Run and Delivery</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="/products">Products</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="/products/{{$product->id}}">{{$product->name}}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Print, Run and Delivery</li>
                </ol>
            </nav>

            @include('includes.messages')

            <div class="container-fluid mt-5 col-lg-6 col-sm-7">
                <div class="card shadow mb-4">
                    <div class="card-header">Print, Run and Delivery</div>

                    <div class="card-body">

                        <form action="/combinations" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{$product->id}}">

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


                            <div class="form-group">
                                <label for="value" class="col-lg-12 control-label">Print, Run and Delivery <span class="text-danger">*</span></label>

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
