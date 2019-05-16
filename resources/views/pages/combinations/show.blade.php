@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Products</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card-body mt-2">
                        <p><strong>Product Name</strong>: {{$product->name}}</p>
                        <p><strong>Product Details</strong>: {{$product->details}}</p>

                        <p><strong>Attributes:</strong></p>
                        <ol>
                            @foreach($product->attributes as $attribute)
                                @if($attribute->name != "Print, Run and Delivery")
                                    <li><a href="/attributes/{{$attribute->id}}">{{$attribute->name}}</a></li>
                                @endif
                            @endforeach
                            <li>Print, Run and Delivery</li>
                        </ol>

                        <a href="{{ action('ProductController@edit', $product->id) }}" class="btn btn-outline-info float-left mr-2">Edit</a>
                        {{--<a href="{{ action('ProductController@edit', $product->id) }}" class="btn btn-outline-info float-left mr-2">Create Combinations</a>--}}

                        {{--@if(Auth::user()->type == 'admin' || Auth::user()->id == $dept->user_id)--}}
                        {{--<form method="POST" action="{{ action('ProductController@destroy', $dept->id) }}" class="float-left">--}}
                            {{--<input type="hidden" name="_method" value="DELETE">--}}
                            {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                            {{--<div>--}}
                                {{--<button type="submit" class="btn btn-outline-danger">Delete</button>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                        {{--@endif--}}
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection