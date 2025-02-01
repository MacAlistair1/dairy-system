
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
                                <div class="card-header lead">बिहानको दुध थप्नुहोस</div>
                                <div class="card-content">
                                        {!! Form::open(['action' => ['MorningMilkController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}
                                        <div class="form-group">
                                            {{ Form::label('title', "ग्राहक नम्बर", ['class' => 'lead', 'style' => 'color:black;font-weight:bold;']) }}
                                            {{ Form::text('customer_id', '', ['class' => 'form-control lead', 'placeholder' => 'Customer No.', 'style' => 'color:black;font-size:20pt;']) }}
                                         </div>
                                         <div class="form-group">
                                                {{ Form::label('title', "दुध परिमाण", ['class' => 'lead', 'style' => 'color:black;font-weight:bold;']) }}
                                                {{ Form::text('milk_qt', '', ['class' => 'form-control lead', 'placeholder' => 'Milk Quantity (in ltr.)', 'style' => 'color:black;font-size:20pt;']) }}
                                             </div>
                                             <div class="form-group">
                                                    {{ Form::label('title', "फ्याट", ['class' => 'lead', 'style' => 'color:black;font-weight:bold;']) }}
                                                    {{ Form::text('fat_point', '', ['class' => 'form-control lead', 'placeholder' => 'Fat', 'style' => 'color:black;font-size:20pt;']) }}
                                                 </div>
                                        {{ Form::submit('थप्नुहोस', ['class' => 'btn btn-primary btn-lg']) }}
                                        {!! Form::close() !!}
                                </div>
                        </div>
                </div>
        </div>
    </div>
@endsection
