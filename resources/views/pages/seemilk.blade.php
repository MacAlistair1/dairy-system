
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

                                    @if (count($mrngmilks) > 0)
                                        <table class="table table-striped pull-left">
                                            <caption style="font-size:15pt;font-weight:bold;color:blue;">जम्मा ग्राहक: {{ changeDigit(count($mrngmilks)) }}</caption>
                                            <tr>
                                                <th>ग्राहक नम्बर</th>
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
                                        @foreach ($mrngmilks as $mrngmilk)
                                            @foreach ($evemilks as $evemilk)
                                                @if ($mrngmilk->customer_id == $evemilk->customer_id)
                                                <tr style="font-weight:bold;font-size:15pt;">
                                                        <td>{{ changeDigit($mrngmilk->customer_id) }}</td>
                                                        <td>{{ changeDigit($mrngmilk->milk_qt) }}</td>
                                                        <td>{{ changeDigit($mrngmilk->fat_point) }}</td>
                                                        <td>{{  changeDigit($evemilk->milk_qt) }}</td>
                                                        <td>{{  changeDigit($evemilk->fat_point) }}</td>
                                                    </tr>
                                                    <?php
                                                        $daymilk+= $mrngmilk->milk_qt;
                                                        $nitmilk+= $evemilk->milk_qt;
                                                    ?>
                                                    <?php
                                                        $dayfat+= $mrngmilk->fat_point;
                                                        $nitfat+= $evemilk->fat_point;
                                                    ?>
                                                @endif
                                           
                                            @endforeach
                                            
                                        @endforeach
                                        <tr style="font-weight:bold;font-size:17pt;color:red;">
                                            <td>जम्मा</td>
                                            <td>{{ changeDigit($daymilk)." लिटर" }}</td>
                                            <td>{{ changeDigit($dayfat) }}</td>
                                            <td>{{ changeDigit($nitmilk)." लिटर" }}</td>
                                            <td>{{ changeDigit($nitfat) }}</td>
                                        </tr>
                                    </table>
                                    @else
                                        <h3><center>कुनैपनि डाटा प्राप्त भएन|</center></h3>
                                    @endif

                                    

                                </div>
                        </div>
                </div>
        </div>
    </div>
@endsection