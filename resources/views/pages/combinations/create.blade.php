@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Combination</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                        <div class="card-body mt-2">
                            <p>Product: <a href="/products/{{$product->id}}">{{$product->name}}</a></p>
                            {{--<p>Attribute: {{$attribute->name}}</p>--}}
                            <form action="{{ action('CombinationController@store', $product) }}" method="POST">
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger">{{ $error }}</p>
                                @endforeach
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

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
                                <div class="form-group mt-5 text-center">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-outline-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
