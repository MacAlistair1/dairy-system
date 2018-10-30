
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
                                <div class="card-header lead">ग्राहक ब्यबस्थापन गर्नुहोस्</div>
                                <div class="card-content">
                                    @if (count($customers) > 0)
                                    <table class="table table-striped">
                                            <tr>
                                                <th>ग्राहक नम्बर</th>
                                                <th>ग्राहकको पुरा नाम</th>
                                                <th>ग्राहकको मोबाईल नम्बर</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                            <?php
                                        function changeDigit($num){
                                            $eng_num = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
                                            $nep_num = array('0', '१', '२', '३', '४', '५', '६', '७', '८', '९');
                                            return str_replace($eng_num, $nep_num, $num);
                                        }
                                       ?>
                                            @foreach ($customers as $customer)
                                                <tr style="font-weight:bold;font-size:15pt;">
                                                    <td>{{ changeDigit($customer->customer_id) }}</td>
                                                    <td>{{ $customer->name }}</td>
                                                    <td>{{ changeDigit($customer->contact) }}</td>
                                                    <td><a href="/customer/{{ $customer->customer_id }}/edit" class="btn btn-primary">परिवर्तन गर्नुहोस्</a></td>
                                                    <td>
                                                            {!! Form::open(['action' => ['CustomerController@destroy', $customer->customer_id], 'method' => 'POST']) !!}
                                                            {{ Form::hidden('_method', 'DELETE') }}
                                                            {{ Form::submit('हटाउनुहोस', ['class' => 'btn btn-danger']) }}
                                                            {!! Form::close() !!}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @else
                                       <h2><center>ग्राहक भेटिएन|</center></h2>
                                   @endif
                                </div>
                        </div>
                </div>
        </div>
    </div>
@endsection