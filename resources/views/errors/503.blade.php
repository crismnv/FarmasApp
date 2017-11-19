@extends('adminlte::layouts.errors')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.serviceunavailable') }}
@endsection
 
@section('main-content')
    
    <h1 class="text-center text-blue"><i class="fa fa-warning text-red fa-2x"></i> {{ trans('adminlte_lang::message.somethingwrong') }} <i class="fa fa-warning text-red  fa-2x"></i></h1>

        <img src="/img/503.png" class="img img-responsive" alt="Error 503" style="height: 150px;width:120px; margin:0 auto;">
        
    <div class="error-page">
        <div class="error-content"> 
            
            <p >
                {{ trans('adminlte_lang::message.mainwhile') }} <a href='{{ url('/home') }}'>{{ trans('adminlte_lang::message.returndashboard') }}</a>
            </p>
        </div>
    </div><!-- /.error-page -->
@endsection
