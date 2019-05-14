@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Attributes</div>

                <form method="POST" action="/saveAttribute">
                    @csrf

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>
                            <ol id="attributes">
                                <li>Print Run & Delivery</li>
                            </ol>
                        </div>
    
                        <div>
                            <input class="btn btn-outline-success" type="submit" value="Submit">
                        </div>
                    </div>
                </form>
                <button class="btn btn-outline-primary" onclick="append()">Add Attribute</button>
            </div>
        </div>
    </div>
</div>


<script>
    function append() {
        var newItem = document.createElement("li");
        // var textnode = document.createTextNode("Watesr");
        // newItem.appendChild(textnode);


        let node_value = document.createElement("input");
        node_value.type = 'text';
        node_value.name = 'attribute[]';
        // node_value.className = 'form-control';
        // node_value.setAttribute("required", "required");
        newItem.appendChild(node_value);



        var list = document.getElementById("attributes");
        list.insertBefore(newItem, list.childNodes[list.childNodes.length-1]);
    }
</script>

@endsection
