
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
                                <div class="card-header lead">नयाँ ग्राहक थप्नुहोस</div>
                                <div class="card-content">
                                        {!! Form::open(['action' => ['CustomerController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}
                                        <div class="form-group">
                                            {{ Form::label('title', "नयाँ ग्राहक नम्बर", ['class' => 'lead', 'style' => 'color:black;font-weight:bold;']) }}
                                            {{ Form::text('customer_id', '', ['class' => 'form-control lead', 'placeholder' => 'New Customer No.', 'style' => 'color:black;font-size:20pt;']) }}
                                         </div>
                                         <div class="form-group">
                                                {{ Form::label('title', "ग्राहकको पुरा नाम", ['class' => 'lead', 'style' => 'color:black;font-weight:bold;']) }}
                                                {{ Form::text('name', '', ['class' => 'form-control lead', 'placeholder' => 'Customer Name', 'style' => 'color:black;font-size:20pt;']) }}
                                             </div>
                                             <div class="form-group">
                                                    {{ Form::label('title', "ग्राहकको मोबाईल नम्बर", ['class' => 'lead', 'style' => 'color:black;font-weight:bold;']) }}
                                                    {{ Form::text('contact', '', ['class' => 'form-control lead', 'placeholder' => 'Customer Phone Number', 'style' => 'color:black;font-size:20pt;']) }}
                                                 </div>
                                        {{ Form::submit('थप्नुहोस', ['class' => 'btn btn-primary btn-lg']) }}
                                        {!! Form::close() !!}
                                </div>
                        </div>
                </div>
        </div>
    </div>
@endsection
