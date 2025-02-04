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
                <div class="card-header lead">आजको दुधको लिस्ट हेर्नुहोस्</div>
                <div class="card-content">
                    @include('admin-inc.search')
                    <?php
                                        function changeDigit($num){
                                            $eng_num = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
                                            $nep_num = array('0', '१', '२', '३', '४', '५', '६', '७', '८', '९');
                                            return str_replace($eng_num, $nep_num, $num);
                                        }
                                       ?>

                    @if (count($groupedMilkData) > 0)
                    <table class="table table-striped pull-left">
                        <caption style="font-size:15pt;font-weight:bold;color:blue;">जम्मा दिन:
                            {{changeDigit(count($groupedMilkData)) }}</caption>
                        <tr>
                            <th>मिति</th>
                            <th>ग्राहक नं</th>
                            <th colspan="2">बिहानको</th>
                            <th colspan="2">बेलुकाको</th>
                        </tr>
                        <tr>
                            <th></th>
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

                            @if (!$milk[0])
                            <td>{{ changeDigit($milk[1]->customer_id) }}</td>
                            @else
                            <td>{{ changeDigit($milk[0]->customer_id) }}</td>
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
                            <td></td>
                            <td>{{ changeDigit($daymilk)." लिटर" }}</td>
                            <td>{{ changeDigit($dayfat) }}</td>
                            <td>{{ changeDigit($nitmilk)." लिटर" }}</td>
                            <td>{{ changeDigit($nitfat) }}</td>
                        </tr>
                    </table>
                    @else
                    <h3>
                        <center>कुनैपनि डाटा प्राप्त भएन|</center>
                    </h3>
                    @endif



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
