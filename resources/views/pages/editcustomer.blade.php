
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
                                <div class="card-header lead">ग्राहकको सुचना परिवर्तन गर्नुहोस्</div>
                                <div class="card-content">
                                        {!! Form::open(['action' => ['CustomerController@update', $customer->customer_id], 'method' => 'POST', 'class' => 'form']) !!}
                                        <div class="form-group">
                                            {{ Form::label('title', "ग्राहक नम्बर", ['class' => 'lead', 'style' => 'color:black;font-weight:bold;']) }}
                                            {{ Form::text('customer_id', $customer->customer_id, ['class' => 'form-control lead', 'placeholder' => 'New Customer Id', 'style' => 'color:black;font-size:20pt;']) }}
                                         </div>
                                         <div class="form-group">
                                                {{ Form::label('title', "ग्राहकको पुरा नाम", ['class' => 'lead', 'style' => 'color:black;font-weight:bold;']) }}
                                                {{ Form::text('name', $customer->name, ['class' => 'form-control lead', 'placeholder' => 'Customer Name', 'style' => 'color:black;font-size:20pt;']) }}
                                             </div>
                                             <div class="form-group">
                                                    {{ Form::label('title', "ग्राहकको मोबाईल नम्बर", ['class' => 'lead', 'style' => 'color:black;font-weight:bold;']) }}
                                                    {{ Form::text('contact', $customer->contact, ['class' => 'form-control lead', 'placeholder' => 'Customer Phone Number', 'style' => 'color:black;font-size:20pt;']) }}
                                                 </div>
                                        {{ Form::hidden('_method', 'PUT') }}
                                        {{ Form::submit('परिवर्तन गर्नुहोस्', ['class' => 'btn btn-primary btn-lg']) }}   
                                        {!! Form::close() !!}
                                </div>
                        </div>
                </div>
        </div>
    </div>
@endsection