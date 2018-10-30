  
<div class="row">
        <div class="col-md-8" style="margin-left:35%;">
    {!! Form::open(['action' => 'SearchController@store', 'method' => 'POST']) !!}
    <table><tr><td>
    {!! Form::text('keyword', '', ['class' => 'form-control', 'placeholder' => 'ग्राहक नम्बरले दुध खोज्नुहोस्........', 'style' => 'font-weight:bold;font-size:15pt;']) !!}
    </td>
    <td>
        {!! Form::submit('खोज्नुहोस्', ['class' => 'btn btn-rose btn-round btn-lg']) !!}
        
    </td>
    {!! Form::close() !!}
    </tr>
    </table>
        </div>
</div>