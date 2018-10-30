@if (Auth::guest())
@section('title')
लगइन गर्नुहोस्
@endsection
@else
@section('title')
स्वागतम
@endsection

@endif

@include('admin-inc.header')

@if (Auth::guest())

<div class="container" style="margin-top:8%;">
<div class="row">
<div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
    <form method="POST" action="{{ route('login') }}">
            @csrf
        <div class="card card-login card-hidden">
            <div class="card-header text-center" data-background-color="rose">
                <h4 class="card-title">{{ 'लगइन गर्नुहोस्' }}</h4> 
            </div>
            <div class="spacer"></div>
            <br>
            <div class="card-content">
                <div class="input-group">
                    <span class="input-group-addon">
                        E
                    </span>
                    <div class="form-group label-floating">
                        <label for="email" class="control-label">{{ 'इमेल' }}</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="admin@gmail.com" required autofocus>
                        @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        P
                    </span>
                    <div class="form-group label-floating">
                        <label for="password" class="control-label">{{ 'पसवोर्ड' }}</label>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>

               

            </div>
            <div class="footer text-center">
                <button type="submit" class="btn btn-primary btn-wd btn-lg">{{ 'लगइन' }}</button><br>
           
            </div>
        </div>
    </form>
</div>
</div>
</div>
@endif
