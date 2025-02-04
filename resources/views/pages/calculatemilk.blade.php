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
                            $nep_num = array('०', '१', '२', '३', '४', '५', '६', '७', '८', '९');
                            return str_replace($eng_num, $nep_num, $num);
                        }
                    ?>
                    <div class="col-md-offset-1 col-md-9" style="margin-top:-4%;">
                        <div class="card card-profile btn btn-round" style="background:whitesmoke;">

                            <div class="card-content">
                                <h4 class="lead text-black"><strong class="pull-left"><b style="color:black;">ग्राहकको
                                            नाम: <b style="color:red;">{{ $customer->name }}</b></b></strong> <strong
                                        class="pull-right"><b style="color:black;">ग्राहक नम्बर: <b
                                                style="color:red;font-size:15pt;">{{ changeDigit($customer->customer_id)
                                                }}</b></b></strong></h4>
                                <br><br>
                                <h4 class="category"><strong class="pull-left"><b style="color:black;">बिहानको जम्मा
                                            दुध: <b style="color:red;">{{ changeDigit($mrngMilk).' लिटर' }}</b>
                                        </b></strong> <strong class="pull-right"><b style="color:black;">बिहानको जम्मा
                                            फ्याट: <b style="color:red;">{{ changeDigit($mrngFat) }}</b> </b></strong>
                                </h4><br>
                                <h4 class="category"><strong class="pull-left"><b style="color:black;">बेलुकाको जम्मा
                                            दुध: <b style="color:red;">{{ changeDigit($eveMilk).' लिटर' }}</b>
                                        </b></strong> <strong class="pull-right"><b style="color:black;">बेलुकाको जम्मा
                                            फ्याट: <b style="color:red;">{{ changeDigit($eveFat) }}</b> </b></strong>
                                </h4><br>
                                <hr width="100%" style="height:2px; background:black;">
                                <h4 class="category"><strong class="pull-left"><b style="color:black;">{{
                                            changeDigit($totDay) }} दिनको जम्मा दुध: <b style="color:red;">{{
                                                changeDigit($totalMilk).' लिटर' }}</b> </b></strong> <strong
                                        class="pull-right"><b style="color:black;">{{ changeDigit($totDay) }} दिनको
                                            जम्मा फ्याट: <b style="color:red;">{{ changeDigit($totalFat) }}</b>
                                        </b></strong></h4><br>
                                <h4 class="category"> <strong class="pull-right"><b style="color:black;">औसत फ्याट: <b
                                                style="color:red;">{{ changeDigit($avgFat) }}</b> </b></strong></h4><br>
                                <h4 class="category"> <strong class="pull-right"><b style="color:black;">१ फ्याटको मुल्य
                                            : <b style="color:red;">{{ 'रू. '.changeDigit($fat_rate) }}</b>
                                        </b></strong></h4><br>
                                <hr width="100%" style="height:2px; background:black;"><br>

                                <h1>
                                    <center><b style="color:black;">जम्मा: </b> <b style="color:red;"> {{ 'रू.
                                            '.changeDigit($totalMoney) }}</b></center>
                                </h1>

                                <hr width="100%" style="height:2px; background:black;">

                                <h4 class="category"> <strong class="pull-right"><b style="color:black;">- पेश्की रकम
                                            जम्मा: <b style="color:red;">{{ 'रू. '.changeDigit($totalAdvanceAmount)
                                                }}</b> </b></strong></h4><br>

                                <hr width="100%" style="height:2px; background:black;">

                                <h1>
                                    <center><b style="color:black;">अब दिन पर्ने जम्मा: </b> <b style="color:red;"> {{
                                            'रू. '.changeDigit($totalMoney-$totalAdvanceAmount) }}</b></center>
                                </h1>

                                <a href="/customer-history/{{ $customer->customer_id.','.$totalMilk.','.$avgFat.','.$totalMoney }}"
                                    class="btn btn-rose btn-round btn-lg">हिस्टोरीमा राख्नुहोस्</a>
                            </div>

                        </div>
                    </div>
                    @endif

                    @if (count($groupedMilkData) > 0)
                    <table class="table table-striped pull-left">
                        <caption style="font-size:15pt;font-weight:bold;color:blue;"> दुधको विवरण | जम्मा दिन: {{
                            changeDigit(count($groupedMilkData)) }} | <b style="color: red;">{{ $startDate }}</b> देखी <b style="color: red;">{{ $endDate }}</b> सम्म
                        </caption>

                        <tr>
                            <th>मिति</th>
                            <th colspan="2">बिहानको</th>
                            <th colspan="2">बेलुकाको</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>दुध</th>
                            <th>फ्याट</th>
                            <th>दुध</th>
                            <th>फ्याट</th>
                        </tr>
                        <?php $daymilk = 0; $nitmilk = 0; ?>
                        <?php $dayfat = 0; $nitfat = 0; ?>

                        @foreach ($groupedMilkData as $index=>$milk)
                        <tr style="font-weight:bold;font-size:15pt;">

                            @if (!$milk[0])
                            <td>{{ $milk[1]->np_date }}</td>
                            @else
                            <td>{{ $milk[0]->np_date }}</td>
                            @endif

                            @if (!isset($milk[1]))
                            <td>--</td>
                            <td>--</td>
                            @else
                            <td>{{ changeDigit($milk[1]->milk_qt) }}</td>
                            <td>{{ changeDigit($milk[1]->fat_point) }}</td>
                            @endif


                            @if (!isset($milk[0]))
                            <td>--</td>
                            <td>--</td>
                            @else
                            <td>{{ changeDigit($milk[0]->milk_qt) }}</td>
                            <td>{{ changeDigit($milk[0]->fat_point) }}</td>
                            @endif
                        </tr>

                        <?php
                        if (isset($milk[1])) {
                            $daymilk+= $milk[1]->milk_qt;
                            $dayfat+= $milk[1]->fat_point;
                        }

                        if (isset($milk[0])) {
                            $nitmilk+= $milk[0]->milk_qt;
                            $nitfat+= $milk[0]->fat_point;
                        }
                        ?>
                        @endforeach

                        <tr style="font-weight:bold;font-size:17pt;color:red;">
                            <td>जम्मा</td>
                            <td>{{ changeDigit($daymilk)." लिटर" }}</td>
                            <td>{{ changeDigit($dayfat) }}</td>
                            <td>{{ changeDigit($nitmilk)." लिटर" }}</td>
                            <td>{{ changeDigit($nitfat) }}</td>
                        </tr>

                    </table>
                    @endif

                    @if (count($advanceAmounts) > 0)
                    <table class="table table-striped pull-left" style="margin-top: 30px;">
                        <caption style="font-size:15pt;font-weight:bold;color:blue;">पेश्की रकम विवरण</caption>
                        <tr>
                            <th>मिति</th>
                            <th>रकम</th>
                            <th>टिप्पणी</th>
                        </tr>

                        @foreach ($advanceAmounts as $index=>$advAmt)
                        <tr style="font-weight:bold;font-size:15pt;">
                            <td>{{ $advAmt->np_date }}</td>
                            <td>{{ changeDigit($advAmt->amount) }}</td>
                            <td>{{ $advAmt->remarks }}</td>
                        </tr>
                        @endforeach

                        <tr style="font-weight:bold;font-size:17pt;color:red;">
                            <td>जम्मा</td>
                            <td>{{ "रू. ".changeDigit($totalAdvanceAmount) }}</td>
                            <td></td>
                        </tr>

                    </table>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
