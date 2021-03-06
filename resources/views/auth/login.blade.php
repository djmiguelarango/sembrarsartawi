@extends('layout')

@section('header')
    @include('auth.header-login')
@endsection

@section('class-container', 'login-container')

@section('content')
    {!! Form::open(['route' => 'auth.login.post', 'method' => 'post']) !!}
    <div class="panel panel-body login-form">
        <div class="text-center">
            {{-- {!! Html::image('images/logo.jpg', '', ['width' => '120']) !!} --}}
            <h5 class="content-group">Acceda a su cuenta
                <small class="display-block">Sus credenciales</small>
            </h5>

        </div>

        <label id="location-error" class="validation-error-label"
               for="location">{{ $errors->first('username') }}</label>
        <div class="form-group has-feedback has-feedback-left">
            {!! Form::text('username', old('username'), ['class' => 'form-control', 'placeholder' => 'Usuario', 'autocomplete' => 'off']) !!}
            <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
            </div>
        </div>

        <label id="location-error" class="validation-error-label"
               for="location">{{ $errors->first('password') }}</label>
        <div class="form-group has-feedback has-feedback-left">
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Contraseña']) !!}
            <div class="form-control-feedback">
                <i class="icon-lock2 text-muted"></i>
            </div>
        </div>
        <div class="form-group login-options">
            <div class="row">
                <div class="col-sm-6">
                    <label class="checkbox-inline">
                        {!! Form::checkbox('remember', null, false, ['class' => 'styled']) !!}
                        Recuérdame
                    </label>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('password.create') }}">¿Has olvidado tu contraseña?</a>
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::button('Iniciar sesión <i class="icon-arrow-right14 position-right"></i>', ['type' => 'submit', 'class' => 'btn bg-blue btn-block']) !!}
        </div>
        <span class="help-block text-center no-margin">Al continuar , usted confirma que ha leído nuestros Terminos &amp; Condiciones</span>
    </div>
    {!! Form::close() !!}
@endsection
