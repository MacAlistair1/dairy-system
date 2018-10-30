
@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection

@section('content')
@include('admin-inc.message')

<div class="container">
        <div class="row">
                <div class="col-md-10">
                        <div class="card">
                                <div class="card-header lead">दुधको लिस्ट हेर्नुहोस्</div>
                                <div class="card-content">
                                        @include('admin-inc.search')

                                
                                    @if (count($mrngmilks) > 0 || count($evemilks) > 0)
                                        <h3>Yes</h3>
                                    @else
                                        <h3>No</h3>
                                    @endif

                                </div>
                        </div>
                </div>
        </div>
    </div>
@endsection