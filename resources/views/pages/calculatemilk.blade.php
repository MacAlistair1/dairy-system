
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
                                <div class="card-header lead">दुधको हिसाब</div>
                                <div class="card-content">
                                        @include('admin-inc.calculation')
                                    
                                   @if ($customer != 'null')
                                   <br><br>
                                   <?php
                                    function changeDigit($num){
                                        $eng_num = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
                                        $nep_num = array('0', '१', '२', '३', '४', '५', '६', '७', '८', '९');
                                        return str_replace($eng_num, $nep_num, $num);
                                    }
                                   ?>
                                   <div class="col-md-offset-1 col-md-9" style="margin-top:-4%;">
                                        <div class="card card-profile btn btn-round" style="background:whitesmoke;">
                                          
                                            <div class="card-content">
                                                <h4 class="lead text-black"><strong class="pull-left"><b style="color:black;">ग्राहकको नाम: <b style="color:red;">{{ $customer->name }}</b></b></strong> <strong class="pull-right"><b style="color:black;">ग्राहक नम्बर: <b style="color:red;font-size:15pt;">{{ changeDigit($customer->customer_id) }}</b></b></strong></h4>
                                                <br><br>
                                               <h4 class="category"><strong class="pull-left"><b style="color:black;">बिहानको जम्मा दुध: <b style="color:red;">{{ changeDigit($mrngMilk).' लिटर' }}</b> </b></strong> <strong class="pull-right"><b style="color:black;">बिहानको जम्मा फ्याट: <b style="color:red;">{{ changeDigit($mrngFat) }}</b> </b></strong></h4><br>
                                               <h4 class="category"><strong class="pull-left"><b style="color:black;">बेलुकाको जम्मा दुध: <b style="color:red;">{{ changeDigit($eveMilk).' लिटर' }}</b> </b></strong> <strong class="pull-right"><b style="color:black;">बेलुकाको जम्मा फ्याट: <b style="color:red;">{{ changeDigit($eveFat) }}</b> </b></strong></h4><br>
                                               <hr width="100%" style="height:2px; background:black;">
                                               <h4 class="category"><strong class="pull-left"><b style="color:black;">{{ changeDigit($totDay) }} दिनको जम्मा दुध: <b style="color:red;">{{ changeDigit($totalMilk).' लिटर' }}</b> </b></strong> <strong class="pull-right"><b style="color:black;">{{ changeDigit($totDay) }} दिनको जम्मा जम्मा फ्याट: <b style="color:red;">{{ changeDigit($totalFat) }}</b> </b></strong></h4><br>
                                               <h4 class="category"> <strong class="pull-right"><b style="color:black;">औसत फ्याट: <b style="color:red;">{{ changeDigit($avgFat) }}</b> </b></strong></h4><br>
                                               <h4 class="category"> <strong class="pull-right"><b style="color:black;">१ फ्याटको मुल्य : <b style="color:red;">{{ 'रू. '.changeDigit($fat_rate) }}</b> </b></strong></h4><br>
                                               <hr width="100%" style="height:2px; background:black;"><br>

                                               <h1><center><b style="color:black;">जम्मा: </b> <b style="color:red;"> {{ 'रू. '.changeDigit($totalMoney) }}</b></center></h1>
                                                <a href="/customer-history/{{ $customer->customer_id.','.$totalMilk.','.$avgFat.','.$totalMoney }}" class="btn btn-rose btn-round btn-lg">हिस्टोरीमा राख्नुहोस्</a>
                                            </div>

                                        </div>
                                    </div>
                                   @endif     
                                   

                                </div>
                        </div>
                </div>
        </div>
    </div>
@endsection