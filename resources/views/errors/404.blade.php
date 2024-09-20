@extends('layouts.app')

@section('content')
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>404 Not found</h2>
                        <span>We could not find your resource .</span>
                        <div class="main-border-button mt-3">
                            <a href="{{ route('allProducts') }}">Explore Products</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
