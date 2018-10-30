  
<div class="row">
    <div class="col-md-8" style="margin-left:35%;margin-top:-8%;">
{!! Form::open(['action' => 'HistoryController@store', 'method' => 'POST']) !!}
<table><tr><td>
{!! Form::text('keyword', '', ['class' => 'form-control', 'placeholder' => 'ग्राहक नम्बरले वा नामले पुरानो हिसाब हेर्नुहोस्', 'style' => 'font-weight:bold;font-size:15pt;']) !!}
</td>
<td>
    {!! Form::submit('पुरानो हिसाब हेर्नुहोस्', ['class' => 'btn btn-rose btn-round btn-lg']) !!}
    
</td>
{!! Form::close() !!}
</tr>
</table>
    </div>
</div>