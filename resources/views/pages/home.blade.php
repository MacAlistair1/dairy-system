
@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection
<?php
function changeDigit($num){
    $eng_num = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    $nep_num = array('0', '१', '२', '३', '४', '५', '६', '७', '८', '९');
    return str_replace($eng_num, $nep_num, $num);
}
?>
@section('content')
@include('admin-inc.message')
<div class="container">
        <div class="row justify-content-center">
              
                <div class="col-md-3">
                        <div class="card card-pricing card-raised ">
                            <a href="/add-customer">
                            <div class="card-content">
                                <h6 class="category"> <img src="{{ asset('img/default-avatar.png') }}" alt="User" style="width:100px;"></h6>
                                <h2 class="card-title" style="font-size:50px;">{{ changeDigit($customers) }} <strong style="font-size:17px;">जना ग्राहक</strong></h2>
                                <b class="card-description" style="font-size:20px;">नयाँ ग्राहक थप्नुहोस</b>
                            </div>
                            </a>
                            <hr>
                            <a href="/manage-customer">
                                <div class="card-content">
                                    <h3 class="card-title" style="font-size:25px;margin-top:-5.5%;">ग्राहक ब्यबस्थापन गर्नुहोस्</h3>
                                </div>
                                </a>
                        </div>
                    </div>
               <a href="/change-fat">
                <div class="col-md-3">
                        <div class="card card-pricing card-raised ">
                            <div class="card-content">
                                <h6 class="category"> <img src="{{ asset('img/change.png') }}" alt="User" style="width:200px;"></h6>
                                <h2 class="card-title" style="font-size:50px;">{{ 'रु.'.changeDigit($fat) }}</h2>
                                <br>
                                <br>
                                <p class="card-description" style="font-size:25px;margin-top:-8.5%;">
                                    फ्याटको मुल्य परिवर्तन गर्नुहोस्      
                                </p>
                                
                            </div>
                        </div>
                    </div>
               </a>

                <div class="col-md-3">
                        <div class="card card-pricing card-raised">
                            <a href="/add-morning-milk">
                            <div class="card-content">
                                <h6 class="category"> <img src="{{ asset('img/add.jpg') }}" alt="Add" style="width:110px;"></h6>
                                <h3 class="card-title" style="margin-top:-1%;">बिहानको दुध हाल्नुहोस</h3>
                            </div>
                            <hr>
                            </a>
                            <a href="/add-evening-milk">
                                    <div class="card-content">
                                        <h6 class="category"> <img src="{{ asset('img/add.jpg') }}" alt="Add" style="width:110px;"></h6>
                                        <h3 class="card-title" style="margin-top:-0.5%;">बेलुकाको दुध हाल्नुहोस</h3>
                                    </div>
                                    </a>
                        </div>
                    </div>
            
            <a href="/calculate-my-money">
                <div class="col-md-2">
                        <div class="card card-pricing card-raised ">
                            <div class="card-content">
                                <h6 class="category"> <img src="{{ asset('img/calculation.png') }}" alt="Calculation" style="width:100px;"></h6>
                                <h2 class="card-title" style="font-size:25px;margin-top:-1%;">हिसाब गर्नुहोस्</h2>
                                
                            </div>
                        </div>
                    </div>
                </a>

                <a href="/history">
                <div class="col-md-2" style="margin-top:-2%;">
                        <div class="card card-pricing card-raised ">
                            <div class="card-content">
                                <h6 class="category"> <img src="{{ asset('img/history.jpg') }}" alt="History" style="width:60px;"></h6>
                               <h2 class="card-title" style="font-size:25px;margin-top:-1%;">पुरानो हिसाब हेर्नुहोस्</h2>
                                
                            </div>
                        </div>
                    </div>
                </a>

        </div>
    </div>
@endsection