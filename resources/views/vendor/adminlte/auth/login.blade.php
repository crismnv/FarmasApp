@extends('adminlte::layouts.app-login')

@section('content')
<div class="container">
<br>
    <br>
    <br>
    <br>
    <br>

        <div class="login-box">
            <div class="col-xs-10 col-xs-offset-1 col-sm-offset-4">
                <div class="login-logo">
                &nbsp;<a href="{{ url('/') }}"><font color="#009688" face="Arial Black" size=20;><i style="color: #00796B" class="fa fa-flask fa-1x" aria-hidden="true"></i>FARMASAPP</font></a>
                
                {{-- <h2 style="color: #ff9800" align="center";><font face="Arial Black" size=10;>ACME</font><i  style="color: #00897b"; class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i></h2> --}}
                
                
                </div>
            </div><!-- /.login-logo -->




        <div class="login-box-body col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3"  style ="background-color: #B2DFDB;">
       
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}" >
                        {{ csrf_field() }}
                        <br>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" >
                            <label for="email" class="col-md-4 control-label">E-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control"  name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block" id="error-email">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block" id="error-pass">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <a href="{{url('registro')}}" style="color: #00796B;">Registrarme</a>
                                        {{-- <a type="" name="remember" > Recuérdame</a> --}}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                                <button type="submit" class="btn " style="background-color:  #00796B; color: #fff;">
                                    Login
                                </button>

                                {{-- <a class="btn btn-link" style="color: #00796B" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a> --}}
                            </div>
                        </div>
                    </form>
                
        </div>

    </div>
    

    

@section('script-fin')
<script>
    $('#email').on("keypress", function()
    {
        // alert();
        $('#error-email').hide();
        $('#error-pass').hide();
    });
</script>

@endsection
