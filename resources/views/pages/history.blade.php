
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
                                <div class="card-header lead">पुरानो दुधको हिसाब </div>
                                <div class="card-content">
                                        @include('admin-inc.history')

                                   @if ($histories != 'null')
                                   <br><br>
                                   <?php
                                    function changeDigit($num){
                                        $eng_num = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
                                        $nep_num = array('0', '१', '२', '३', '४', '५', '६', '७', '८', '९');
                                        return str_replace($eng_num, $nep_num, $num);
                                    }
                                   ?>
                                   <div class="col-md-offset-1 col-md-10" style="margin-top:-4%;">
                                        <div class="card card-profile btn btn-round" style="background:whitesmoke;">

                                            <div class="card-content">
                                                <h4 class="lead text-black"><strong class="pull-left"><b style="color:black;">ग्राहकको नाम: <b style="color:red;">{{ $customer->name }}</b></b></strong> <strong class="pull-right"><b style="color:black;">ग्राहक नम्बर: <b style="color:red;font-size:15pt;">{{ changeDigit($customer->customer_id) }}</b></b></strong></h4>
                                                <br><hr width="100%" style="height:2px; background:black;"><br>


                                                @if (count($histories) > 0)
                                                    <table class="table table-striped" border="3px">
                                                        <tr style="color:black;font-weight:bold;">
                                                            <th>मिति</th>
                                                            <th>जम्मा दुध परिमाण</th>
                                                            <th>औषत फ्याट</th>
                                                            <th>जम्मा रूपियाँ</th>
                                                            <th>जम्मा पेश्की रकम</th>
                                                            <th></th>
                                                        </tr>


                                                    @foreach ($histories as $history)

                                                        <tr style="color:black;font-weight:bold;font-size:13pt;">
                                                            <td>{{ changeDigit($history->to_from_date) }}</td>
                                                            <td>{{ changeDigit($history->total_milk).' लि.' }}</td>
                                                            <td>{{ changeDigit($history->avg_fat) }}</td>
                                                            <td>{{ 'रु. '.changeDigit($history->total_Money) }}</td>
                                                            <td>{{ 'रु. '.changeDigit($history->settled_adv_amount) }}</td>
                                                            <td><a href="delete-history/{{ $history->id }}" class="btn btn-rose btn-round btn-sm">हटाउनुहोस</a></td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                                @else
                                                    <h3 class="lead text-balck"><center><b style="color:black;">डाटा प्राप्त भएन</b></center></h3>
                                                @endif

                                        </div>
                                    </div>
                                   @endif


                                </div>
                        </div>
                </div>
        </div>
    </div>
@endsection
