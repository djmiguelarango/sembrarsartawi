@extends('admin.layout')

@section('menu-user')
    @include('admin.partials.menu-user')
@endsection

@section('menu-main')
    @include('admin.partials.menu-main')
@endsection

@section('header')
    @include('admin.partials.header')
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="form-wizard-title text-semibold" style="border-bottom: 0px;">
                <span class="form-wizard-count">
                    <i class="icon-pencil6"></i>
                </span>
                Formulario
                <small class="display-block">Nuevo registro</small>
            </h5>
            <div class="heading-elements">

            </div>
        </div>
        @if (session('error'))
            <div class="alert alert-danger alert-styled-left alert-bordered">
                <span class="text-semibold">Error!</span> {{ session('error') }}
            </div>
        @endif
        <div class="panel-body">

            {!! Form::open(array('route' => 'create_user', 'name' => 'userForm', 'id' => 'userForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
                <fieldset class="content-group">

                    <div class="form-group">
                        <label class="control-label col-lg-2">Retailer <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            @if(count($retailer)>0)
                                <select name="id_retailer" id="id_retailer" class="form-control required">
                                    <option value="0">Seleccione</option>
                                    @foreach($retailer as $data_retailer)
                                        <option value="{{$data_retailer->id}}">{{$data_retailer->name}}</option>
                                    @endforeach
                                </select>
                            @else
                                <div class="alert alert-warning alert-styled-left">
                                    <span class="text-semibold"></span> No existe Retailer registrado.<br>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Tipo de usuario <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select name="tipo_usuario" id="tipo_usuario" class="form-control required">
                                <option value="0">Seleccione</option>
                                @foreach($query_type_user as $type)
                                    <option value="{{$type->id}}|{{$type->code}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="display: none;" id="content-user-profiles">
                        <label class="control-label col-lg-2">Perfiles <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select id="id_profile" name="id_profile" class="">
                                <option value="0">Seleccione</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="display: none;" id="content-permissions">
                        <label class="control-label col-lg-2">Permisos </label>
                        <div class="col-lg-10">
                            <select multiple="multiple" class="" name="permiso[]" id="permiso">
                                @foreach($permissions as $dat_per)
                                    <option value="{{$dat_per->id}}">{{$dat_per->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Departamento <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            @if(!empty($cities))
                                <select name="depto" class="form-control required" id="depto">
                                    <option value="0">Seleccione</option>
                                    @foreach($cities as $data)
                                        <option value="{{$data->id_retailer_city}}|{{$data->id_city}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                            @else
                                <div class="alert alert-warning alert-styled-left">
                                    <span class="text-semibold"></span> No existe departamentos registrados en el Retailer.<br>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group" style="display: none;" id="content-agency">
                        <label class="control-label col-lg-2">Agencia <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select id="agencia" name="agencia" class="form-control required">
                                <option value="0">Seleccione</option>
                            </select>
                            <div id="msg_agencia"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Usuario <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control required" name="txtIdusuario" id="txtIdusuario" autocomplete="off">
                            <div id="msg_usuario"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Contraseña <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control required" name="contrasenia" id="contrasenia" maxlength="14">
                        </div>
                        <div id="messages"></div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Confirmar Contraseña <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control required" name="confirmar" id="confirmar" maxlength="14">
                            <div id="msg_confirmar"><div id="error_contrasenia_igual"></div></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Nombre Completo <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control required text" name="txtNombre" id="txtNnombre" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Telefono agencia</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control not-required number" name="txtTelefono" id="txtTelefono" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Correo electronico <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control required email" name="txtEmail" id="txtEmail" autocomplete="off">
                        </div>
                    </div>

                </fieldset>

                <div class="text-right">
                    @if(count($retailer)>0 && count($cities)>0)
                        <button type="submit" class="btn btn-primary">
                            Guardar <i class="icon-floppy-disk position-right"></i>
                        </button>
                    @else
                        <button type="submit" class="btn btn-primary" disabled>
                            Guardar <i class="icon-floppy-disk position-right"></i>
                        </button>
                    @endif
                    <a href="{{route('admin.user.list', ['nav'=>'user', 'action'=>'list'])}}" class="btn btn-primary">
                        Cancelar <i class="icon-cross position-right"></i>
                    </a>
                    @if(empty($cities))
                        <a href="{{route('admin.cities.list-city-retailer', ['nav'=>'city', 'action'=>'list_city_retailer'])}}" class="btn btn-primary">
                            Agregar departamentos a Retailer <i class="icon-pencil3 position-right"></i>
                        </a>
                    @endif
                </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){

            //OBTENER LISTA DE AGENCIAS DE ACUERDO AL DEPARTAMENTO
            $('#depto').change(function(e) {
                var  _data= $(this).prop('value');
                var array = _data.split('|');
                var id_retailer_city = array[0];
                //alert(id_retailer_city);
                $.get( "{{url('/')}}/admin/user/agency_ajax/"+id_retailer_city, function( data ) {
                    console.log(data);
                    $('#content-agency').fadeIn('slow');
                    $('#agencia option').remove();
                    $('#agencia').append('<option value="0">Seleccione</option>');
                    if(data.length>0) {
                        $('#msg_agencia').html('');
                        $.each(data, function () {
                            console.log("ID: " + this.id);
                            console.log("First Name: " + this.name);
                            $('#agencia').append('<option value="'+this.id+'">'+this.name+'</option>');
                        });
                    }else{
                        $('#msg_agencia').html('<div class="alert alert-warning alert-styled-left"><span class="text-semibold"></span> No existen agencias agregadas al departamento.<br><a href="{{route('admin.agencies.list-agency-retailer', ['nav'=>'agency', 'action'=>'list_agency_retailer'])}}">Ingresar agencias a departamento</a></div>');
                    }
                });
            });

            //OBTENER EL LISTA DE PERFILES DE USUARIO
            $('#tipo_usuario').change(function(e){
                var _id = $(this).prop('value');
                var arr = _id.split("|");
                var tipo_usuario = arr[0];
                if(arr[1]=='UST'){
                    //alert(tipo_usuario);
                    $.get( "{{url('/')}}/admin/user/profiles_ajax/"+tipo_usuario, function( data ) {
                        $('#permiso').addClass('form-control');
                        $('#content-permissions').fadeIn('fast');
                        $('#id_profile').addClass('form-control required');
                        $('#content-user-profiles').fadeIn('fast');
                        $('#id_profile option').remove();
                        $('#id_profile').append('<option value="0">Seleccione</option>');
                        if(data.length>0){
                            $.each(data, function () {
                                console.log("ID: " + this.id);
                                console.log("Profiles: " + this.name);
                                $('#id_profile').append('<option value="'+this.id+'">'+this.name+'</option>');
                            });
                        }
                    });
                    //$('#content-user-profiles').fadeIn('slow');
                }else{
                    $('#id_profile').removeClass('form-control required');
                    $('#content-user-profiles').fadeOut('fast');
                    $('#permiso').removeClass('form-control');
                    $('#content-permissions').fadeOut('fast');
                }
            });

            //VERIFICAMOS SI EL USUARIO EXISTE
            $("#txtIdusuario").blur(function(e){
                var usuario = $("#txtIdusuario").prop('value');
                //alert(usuario);
                if(usuario.match(/^[a-zA-Z]+$/)){
                    $.get( "{{url('/')}}/admin/user/finduser_ajax/"+usuario, function( data ) {
                        console.log(data);
                        if(data.length>0){
                            $('#msg_usuario').html('el usuario '+usuario+' ya existe');
                            $('#txtIdusuario').focus();
                            $('button[type="submit"]').prop('disabled', true);
                        }else{
                            $('#msg_usuario').html('');
                            $('button[type="submit"]').prop('disabled', false);
                        }
                    });
                }else{
                    $("#txtIdusuario").prop('value','');
                }
            });

            //CONFIRMAR SI EXISTE CORREO ELECTRONICO
            $('#txtEmail').keyup(function(){
                var email = $(this).prop('value');
                var regex = /^([a-z]+[a-z0-9._-]*)@{1}([a-z0-9\.]{2,})\.([a-z]{2,3})$/;
                if(regex.test(email)){
                    /*

                    */
                    $.get( "{{url('/')}}/admin/user/find_email_ajax/"+email, function( data ) {
                        console.log(data);
                        if(data==0){
                            if($("#txtEmail + .validation-error-label").length) {
                                $("#txtEmail + .validation-error-label").remove();
                            }
                            $('button[type="submit"]').prop('disabled', false);
                        }else{
                            if($("#txtEmail + .validation-error-label").length) {
                                $("#txtEmail + .validation-error-label").remove();
                            }
                            if(!$("#txtEmail + .validation-error-label").length) {
                                $("#txtEmail:last").after('<span class="validation-error-label">El email ya existe, ingrese otro</span>');
                            }
                        }
                    });
                }else{
                    if($("#txtEmail + .validation-error-label").length) {
                        $("#txtEmail + .validation-error-label").remove();
                    }
                    $('button[type="submit"]').prop('disabled', true);
                    if(!$("#txtEmail + .validation-error-label").length) {
                        $("#txtEmail:last").after('<span class="validation-error-label">Email invalido</span>');
                    }
                }
            });

            //CONFIRMAMOS CONTRASEÑA
            $('#confirmar').keyup(function(e){
                var password_repite = $('#confirmar').prop('value');
                var password_nuevo = $('#contrasenia').prop('value');

                if(password_nuevo==password_repite){
                    $('button[type="submit"]').prop('disabled', false);
                    $("#msg_confirmar").html('contrase&ntilde;as iguales');
                    setTimeout(function() {
                        // Do something after 2 seconds
                        $("#msg_confirmar").html('');
                    }, 3000);
                }else{
                    $('button[type="submit"]').prop('disabled', true);
                    $("#msg_confirmar").html("Las contrase&ntilde;as tienen que ser iguales");
                    //$("#txtPassRepite").css({'border' : '1px solid #d44d24'}).focus();
                    e.preventDefault();
                    //$("#btn_cambiar_pass").attr("disabled", true);
                }

                //alert(confirmar);
            });

            //VERIFICAMOS EL FORMULARIO
            $('#userForm').submit(function(e){
                var sw = true;
                var err = 'Esta informacion es obligatoria';
                $(this).find('.required, .not-required').each(function(index, element) {
                    //alert(element.type+'='+element.value);
                    if($(this).hasClass('required') === true){
                        if(validateElement(element,err) === false){
                            sw = false;
                        }else if(validateElementType(element,err) === false){
                            sw = false;
                        }
                    }else if($(this).hasClass('not-required') === true){
                        removeClassE(element);
                        if(validateElementType(element,err) === false){
                            sw = false;
                        }
                    }
                });
                if(sw==true){
                    $('button[type="submit"]').prop('disabled', true);
                }else{
                    e.preventDefault();
                }
            });

            //VALIDAMOS ELEMENTO
            function validateElement(element,err){
                var _value = $(element).prop('value');
                var _type = $(element).prop('type');
                if(_type=='select-one'){
                    if(_value==0){
                        addClassE(element,err);
                        return false;
                    }else{
                        removeClassE(element,err);
                        return true;
                    }
                }else{
                    if(_value==''){
                        addClassE(element,err);
                        return false;
                    }else{
                        removeClassE(element,err);
                        return true;
                    }
                }
            }
            //ADICIONAMOS CLASE
            function addClassE(element,err){
                var _id = $(element).prop('id');
                //$(element).addClass('error-text');
                if(!$("#"+_id+" + .validation-error-label").length) {
                    $("#"+_id+":last").after('<span class="validation-error-label">'+err+'</span>');
                }
            }
            //REMOVEMOS CLASE
            function removeClassE(element){
                var _id = $(element).prop('id');
                //$(element).removeClass('error-text');
                if($("#"+_id+" + .validation-error-label").length) {
                    $("#"+_id+" + .validation-error-label").remove();
                }
            }
            //VALIDAR TIPO DE ELEMENTO
            function validateElementType(element,err){
                var _value = $(element).prop('value');
                var regex = null;
                if($(element).hasClass('email') === true){
                    regex = /^([a-z]+[a-z0-9._-]*)@{1}([a-z0-9\.]{2,})\.([a-z]{2,3})$/;
                    err = 'Email invalido';
                }else if($(element).hasClass('text') === true){
                    regex = /^[a-zA-ZáÁéÉíÍóÓúÚñÑüÜ\s]*$/;
                    err = 'Ingrese solo texto';
                }else if($(element).hasClass('number') === true){
                    regex = /^([0-9])*$/;
                    err = 'Ingrese solo numeros';
                }

                if(regex !== null){
                    if(!(regex.test(_value)) && _value.length !== 0){
                        addClassE(element,err);
                        $(element).prop('value', '');
                        return false;
                    }else{
                        removeClassE(element,err);
                        return true;
                    }
                }else{
                    return true;
                }
            }
        });
    </script>
@endsection