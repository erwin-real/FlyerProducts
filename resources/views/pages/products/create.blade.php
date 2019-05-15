@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Product</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div class="card-body mt-2">
                            <form action="{{ action('ProductController@store') }}" method="POST">
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
                                            <input type="text" class="form-control" id="name" placeholder="Name of Product" name="name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="details" class="col-lg-12 control-label">Product Details</label>
                                        <div class="col-lg-12">
                                            <textarea class="form-control" rows="3" id="details" name="details"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-10 col-lg-offset-2">
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
</div>

@endsection
