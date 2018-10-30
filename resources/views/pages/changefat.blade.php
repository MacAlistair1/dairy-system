
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
                                <div class="card-header lead">फ्याटको मुल्य परिवर्तन</div>
                                <div class="card-content">
                                        {!! Form::open(['action' => ['FatController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}
                                        <div class="form-group">
                                            {{ Form::label('title', "फ्याटको मुल्य", ['class' => 'lead', 'style' => 'color:black;font-weight:bold;']) }}
                                            {{ Form::text('fat_rate', $fat->fat_rate, ['class' => 'form-control lead', 'placeholder' => 'Fat Price', 'style' => 'color:black;font-size:20pt;']) }}
                                         </div>
                                        {{ Form::submit('परिवर्तन गर्नुहोस्', ['class' => 'btn btn-primary btn-lg']) }}   
                                        {!! Form::close() !!}
                                </div>
                        </div>
                </div>
        </div>
    </div>
@endsection