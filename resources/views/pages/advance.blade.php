
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
                                <div class="card-header lead">ग्राहकलाई दिएको अग्रिम रकम/सामान थप्नुहोस</div>
                                <div class="card-content">
                                        {!! Form::open(['action' => ['AdvanceAmountController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}
                                        <div class="form-group">
                                            {{ Form::label('title', "ग्राहक नम्बर", ['class' => 'lead', 'style' => 'color:black;font-weight:bold;']) }}
                                            {{ Form::text('customer_id', '', ['class' => 'form-control lead', 'placeholder' => 'Customer No.', 'style' => 'color:black;font-size:20pt;']) }}
                                         </div>
                                         <div class="form-group">
                                                {{ Form::label('title', "रकम", ['class' => 'lead', 'style' => 'color:black;font-weight:bold;']) }}
                                                {{ Form::text('amount', '', ['class' => 'form-control lead', 'placeholder' => 'दिएको अग्रिम रकम वा सामानको रकम', 'style' => 'color:black;font-size:20pt;']) }}
                                             </div>
                                             <div class="form-group">
                                                    {{ Form::label('title', "टिप्पणी", ['class' => 'lead', 'style' => 'color:black;font-weight:bold;']) }}
                                                    {{ Form::text('remarks', '', ['class' => 'form-control lead', 'placeholder' => 'सामानको विवरण वा रकमको टिप्पणी (नेपाली मिति सहित)', 'style' => 'color:black;font-size:20pt;']) }}
                                                 </div>
                                                 <div class="form-group">
                                                    {{ Form::label('title', "मिति", ['class' => 'lead', 'style' =>
                                                    'color:black;font-weight:bold;']) }}
                                                    {{ Form::text('np_date', '', ['class' => 'form-control lead np-picker', 'placeholder' => 'मिति', 'style'
                                                    => 'color:black;font-size:20pt;']) }}
                                                </div>
                                        {{ Form::submit('थप्नुहोस', ['class' => 'btn btn-primary btn-lg']) }}
                                        {!! Form::close() !!}
                                </div>
                        </div>
                </div>
        </div>
    </div>
@endsection
