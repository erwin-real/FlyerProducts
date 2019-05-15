@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Product</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                            <form action="{{ action('ProductController@update', $product) }}" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger">{{ $error }}</p>
                                @endforeach
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <fieldset>
                                    <div class="form-group">
                                        <label for="name" class="col-lg-12 control-label">Product Name <span class="text-danger">*</span></label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control" id="name" placeholder="Name of Product" name="name" value="{{$product->name}}" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="details" class="col-lg-12 control-label">Product Details</label>
                                        <div class="col-lg-12">
                                            <textarea class="form-control" rows="3" id="details" name="details">{{$product->details}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="attributes" class="col-lg-12 control-label">Attributes</label>
                                        <ol id="attributes">
                                            @foreach($product->attributes as $attribute)
                                                <li><input type="text" name="attribute[]" value="{{$attribute->name}}"> <span class="text-danger" style="cursor: pointer;" onclick="deleteItem(this)">x</span></li>
                                            @endforeach
                                            <li>Print Run & Delivery</li>
                                        </ol>
                                    </div>
                                    <a class="ml-3 btn btn-outline-primary" onclick="append()">Add Attribute</a>

                                    <div class="form-group mt-3">
                                        <div class="col-lg-12 text-center">
                                            <button type="submit" class="btn btn-outline-primary">Submit</button>
                                        </div>
                                    </div>
                                </fieldset>
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
