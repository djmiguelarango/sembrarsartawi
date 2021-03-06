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
                <small class="display-block">Editar registro</small>
            </h5>
            <div class="heading-elements">

            </div>
        </div>
        @include('admin.partials.message')
        <div class="panel-body">

            {!! Form::open(array('route' => 'update_user', 'name' => 'userUpdateForm', 'id' => 'userUpdateForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
                @if(!empty($user_find))
                    @var $sw=1;
                    @if(!empty($user_find->ad_city_id))
                        @var $style = ''
                    @else
                        @var $style = 'display: none;'
                    @endif

                    @if($user_find->code=='UST')
                        @if(!empty($profile_find->ad_profile_id))
                            @if($profile_find->profile=='COP')
                                @if(empty($user_find->ad_agency_id))
                                    @var $style = 'display: none;'
                                    @var $class = ''
                                @endif
                            @else
                                @var $style_agency = ''
                                @var $class = 'form-control required'
                            @endif
                        @else
                            @var $style_agency = ''
                            @var $class = 'form-control required'
                        @endif
                    @else
                        @var $style = ''
                        @var $class = 'form-control required'
                    @endif

                        <fieldset class="content-group">

                            <div class="form-group">
                                <label class="control-label col-lg-2">Tipo de usuario <span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <select name="tipo_usuario" id="tipo_usuario" class="form-control required">
                                        <option value="0">Seleccione</option>
                                        @foreach($query_type_user as $type)
                                            @if(auth()->user()->type->code=='ADT')
                                                @if($user_find->ad_user_type_id==$type->id)
                                                    <option value="{{$type->id}}|{{$type->code}}" selected>{{$type->name}}</option>
                                                @else
                                                    <option value="{{$type->id}}|{{$type->code}}">{{$type->name}}</option>
                                                @endif
                                            @else
                                                @if($user_find->ad_user_type_id==$type->id)
                                                    <option value="{{$type->id}}|{{$type->code}}" selected>{{$type->name}}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @if($user_find->code=='UST' || $user_find->code=='OPT')
                                @var $dt_var = 0
                                @if($user_find->code=='UST')
                                    <div class="form-group" id="content-user-profiles-edit">
                                        <label class="control-label col-lg-2">Perfiles <span class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <select id="id_profile" name="id_profile" class="form-control required">
                                                <option value="0">Seleccione</option>
                                                @foreach($query_prof as $dat_prof)
                                                    @if(!empty($profile_find->ad_profile_id))
                                                        @if($profile_find->ad_profile_id==$dat_prof->id)
                                                            <option value="{{$dat_prof->id}}|{{$dat_prof->slug}}" selected>{{$dat_prof->name}}</option>
                                                        @else
                                                            <option value="{{$dat_prof->id}}|{{$dat_prof->slug}}">{{$dat_prof->name}}</option>
                                                        @endif
                                                    @else
                                                        <option value="{{$dat_prof->id}}|{{$dat_prof->slug}}">{{$dat_prof->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if($profile_find->profile=='COP')
                                        <div class="form-group" id="content-company">
                                            <label class="control-label col-lg-2">Compañías <span class="text-danger">*</span></label>
                                            <div class="col-lg-10">
                                                <select id="id_company" name="id_company" class="form-control required">
                                                    <option value="0">Seleccione</option>
                                                    @foreach($query_company as $data_company)
                                                        @if($user_find->ad_company_id==$data_company->id)
                                                            <option value="{{$data_company->id}}" selected>{{$data_company->name}}</option>
                                                        @else
                                                            <option value="{{$data_company->id}}">{{$data_company->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <div id="msg_company"></div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                <div class="form-group" id="content-permissions">
                                    <label class="control-label col-lg-2">Permisos </label>
                                    <div class="col-lg-10">
                                        <select multiple="multiple" class="form-control" name="permiso[]" id="permiso" data-popup="tooltip" title="Presione la tecla [Ctrl] para seleccionar mas opciones">
                                            @foreach($permissions_list as $dat_per)
                                                @if(count($user_permission)>0)
                                                    @foreach($user_permission as $dat_idp)
                                                        @if($dat_idp->ad_permission_id==$dat_per->id)
                                                            <option value="{{$dat_per->id}}" selected>{{$dat_per->name}}</option>
                                                            @var $dt_var = $dat_per->id
                                                        @endif
                                                    @endforeach
                                                    @if($dt_var != $dat_per->id)
                                                        <option value="{{$dat_per->id}}">{{$dat_per->name}}</option>
                                                    @endif
                                                @else
                                                    <option value="{{$dat_per->id}}">{{$dat_per->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @else
                                <div class="form-group" style="display: none;" id="content-user-profiles-new">
                                    <label class="control-label col-lg-2">Perfiles <span class="text-danger">*</span></label>
                                    <div class="col-lg-10">
                                        <select id="id_profile" name="id_profile" class="">
                                            <option value="0">Seleccione</option>
                                            @foreach($query_prof as $dat_prof)
                                                <option value="{{$dat_prof->id}}|{{$dat_prof->slug}}">{{$dat_prof->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" style="display: none;" id="content-permissions">
                                    <label class="control-label col-lg-2">Permisos </label>
                                    <div class="col-lg-10">
                                        <select multiple="multiple" class="" name="permiso[]" id="permiso">
                                            @foreach($permissions_list as $dat_per)
                                                <option value="{{$dat_per->id}}">{{$dat_per->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group">
                                <label class="control-label col-lg-2">Retailer <span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <strong>{{$retailer->name}}</strong>
                                </div>
                            </div>
                            @if($user_find->code=='UST')
                                @var $dt_prod = 0
                                @if($profile_find->profile=='SEP')
                                    <div class="form-group" id="content-product">
                                        <label class="control-label col-lg-2">Productos <span class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <select multiple="multiple" class="form-control required" name="product[]" id="product" data-popup="tooltip" title="Presione la tecla [Ctrl] para seleccionar mas opciones o deseleccionarlos">
                                                @foreach($query_product as $data_product)
                                                    @if(count($query_user_product)>0)
                                                        @foreach($query_user_product as $data_user_product)
                                                            @if($data_user_product->ad_product_id == $data_product->id)
                                                                <option value="{{$data_product->id}}" selected>{{$data_product->name}}</option>
                                                                @var $dt_prod = $data_product->id
                                                            @endif
                                                        @endforeach
                                                        @if($dt_prod!=$data_product->id)
                                                                <option value="{{$data_product->id}}">{{$data_product->name}}</option>
                                                        @endif
                                                    @else
                                                        <option value="{{$data_product->id}}">{{$data_product->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif
                            <div class="form-group">
                                <label class="control-label col-lg-2">Departamento <span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    @if(!empty($cities))
                                        <select name="depto" class="form-control required" id="depto">
                                            <option value="0">Seleccione</option>
                                            @foreach($cities as $arrcity)
                                                @if($user_find->ad_city_id==$arrcity->id_city)
                                                    <option value="{{$arrcity->id_retailer_city}}|{{$arrcity->id_city}}" selected>{{$arrcity->name}}</option>
                                                @else
                                                    <option value="{{$arrcity->id_retailer_city}}|{{$arrcity->id_city}}">{{$arrcity->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    @else
                                        <div class="alert alert-warning alert-styled-left">
                                            <span class="text-semibold">Warning!</span> No existe departamentos registrados en el Retailer.<br>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group" style="{{$style}}" id="content-agency">
                                <label class="control-label col-lg-2">Agencia <span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <select id="agencia" name="agencia" class="{{$class}}">
                                        <option value="0">Seleccione</option>
                                        @if(count($agencies)>0)
                                            @foreach($agencies as $arragency)
                                                @if($arragency->id==$user_find->ad_agency_id)
                                                    <option value="{{$arragency->id}}" selected>{{$arragency->name}}</option>
                                                @else
                                                    <option value="{{$arragency->id}}">{{$arragency->name}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    <span id="msg_agencia"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2">Usuario</label>
                                <div class="col-lg-10" style="font-weight: bold;">
                                    {{$user_find->username}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2">Nombre Completo <span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control required" name="txtNombre" id="txtNnombre" autocomplete="off" value="{{$user_find->full_name}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2">Telefono agencia</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="txtTelefono" id="txtTelefono" autocomplete="off" value="{{$user_find->phone_number}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2">Correo electrónico <span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control required" name="txtEmail" id="txtEmail" autocomplete="off" value="{{$user_find->email}}">
                                </div>
                            </div>

                        </fieldset>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                            Guardar <i class="icon-floppy-disk position-right"></i>
                        </button>

                        <a href="{{ route('admin.user.list', ['nav'=>'user', 'action'=>'list']) }}" class="btn btn-primary">
                            Cancelar <i class="icon-arrow-right14 position-right"></i>
                        </a>
                        @if(empty($cities))
                            <a href="{{route('admin.cities.list-city-retailer', ['nav'=>'city', 'action'=>'list_city_retailer'])}}" class="btn btn-primary">
                                Agregar departamentos a Retailer <i class="icon-pencil3 position-right"></i>
                            </a>
                        @endif
                        <input type="hidden" id="id_user" name="id_user" id="id_user" value="{{$user_find->id_user}}">
                        <input type="hidden" id="code" name="code" value="{{$user_find->code}}">
                        <input type="hidden" id="id_retailer_user" name="id_retailer_user" value="{{$user_find->id_retailer_user}}">
                    </div>
                @endif
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            if($('#code').prop('value')=='OPT'){
                $('#tipo_usuario option[value="OPT"]').prop('selected',true);
                $('#tipo_usuario option').not(':selected').attr('disabled', true);
            }else if($('#code').prop('value')=='UST'){
                var arr_profile = ($('#id_profile option:selected').prop('value')).split('|');
                $('#tipo_usuario option[value="UST"]').prop('selected',true);
                $('#tipo_usuario option').not(':selected').attr('disabled', true);
                if(arr_profile[1]=='SEP'){
                    $('#id_profile option[value="SEP"]').prop('selected',true);
                    $('#id_profile option').not(':selected').attr('disabled', true);
                }
            }
            $('#tipo_usuario').triggerHandler('change');
            $('#id_profile').triggerHandler('change');

            //OBTENER LISTA DE AGENCIAS DE ACUERDO AL DEPARTAMENTO
            $('#depto').change(function(e) {
                var  _data= $(this).prop('value');
                var array = _data.split('|');
                var id_retailer_city = array[0];
                var _datatu = $('#tipo_usuario option:selected').prop('value');
                var vec = _datatu.split('|');
                //alert(id_retailer_city);
                if(id_retailer_city!=0){
                    if(vec[1]=='UST') {
                        var id_profile = $('#id_profile option:selected').prop('value').split('|');
                        if(id_profile[1]!='COP'){
                            $.get("{{url('/')}}/admin/user/agency_ajax/" + id_retailer_city, function (data) {
                                //console.log(data);
                                $('#content-agency').fadeIn('slow');
                                $('#agencia option').remove();
                                $('#agencia').addClass('form-control required');
                                $('#agencia').append('<option value="0">Seleccione</option>');
                                if (data.length > 0) {
                                    $('#msg_agencia').html('');
                                    $.each(data, function () {
                                        //console.log("ID: " + this.id);
                                        //console.log("First Name: " + this.name);
                                        $('#agencia').append('<option value="' + this.id + '">' + this.name + '</option>');
                                    });
                                } else {
                                    $('#msg_agencia').html('No existe ningun registro');
                                }
                            });
                        }else{
                            $('#content-agency').fadeOut('fast');
                            $('#agencia').removeClass('form-control required');
                        }
                    }else{
                        $.get("{{url('/')}}/admin/user/agency_ajax/" + id_retailer_city, function (data) {
                            //console.log(data);
                            $('#content-agency').fadeIn('slow');
                            $('#agencia option').remove();
                            $('#agencia').append('<option value="0">Seleccione</option>');
                            if (data.length > 0) {
                                $('#msg_agencia').html('');
                                $.each(data, function () {
                                    //console.log("ID: " + this.id);
                                    //console.log("First Name: " + this.name);
                                    $('#agencia').append('<option value="' + this.id + '">' + this.name + '</option>');
                                });
                            } else {
                                $('#msg_agencia').html('No existe ningun registro');
                            }
                        });
                    }
                }else{
                    $('#agencia option[value="0"]').prop('selected',true);
                    $('#content-agency').fadeOut('fast');
                }
            });

            //HABILITAR SELECT PROFILE
            $('#tipo_usuario').change(function(){
                var _id = $(this).prop('value');
                //alert(_id);
                var arr = _id.split("|");
                var _code_db = $('#code').prop('value');
                var id_user = $('#id_user').prop('value');
                alert('_code_db: '+_code_db+ '  arr: '+arr[1]);
                if(_code_db=='UST'){
                    if(arr[1]=='UST'){
                        $('#content-user-profiles-edit').fadeIn('fast');
                        $( "#id_profile" ).addClass("form-control required");
                        $('#content-permissions').fadeIn('fast');
                        $('#permiso').addClass('form-control');
                    }else{
                        $('#content-user-profiles-edit').fadeOut('fast');
                        $('#id_profile option[value="0"]').prop('selected',true);
                        $( "#id_profile" ).removeClass("form-control required");
                        $('#content-permissions').fadeOut('fast');
                        $('#permiso').removeClass('form-control');
                        $('#permiso option:selected').removeAttr("selected");
                        $('#content-company').fadeOut('fast');
                        $('#id_company option[value="0"]').prop('selected',true);
                        $('#id_company').removeClass('form-control required');

                        //$.get( "{{url('/')}}/admin/user/disabled_ajax/"+id_user, function( data ) {
                            //console.log(data);
                        //});
                    }
                }else{
                    if(arr[1]=='UST'){
                        $('#content-user-profiles-new').fadeIn('fast');
                        $( "#id_profile" ).addClass("form-control required");
                        $('#content-permissions').fadeIn('fast');
                        $('#permiso').addClass('form-control');

                        $('#depto option[value="0"]').prop('selected',true);
                        $('#agencia option[value="0"]').prop('selected',true);
                        $('#content-agency').fadeOut('fast');
                    }else{
                        $('#content-user-profiles-new').fadeOut('fast');
                        $( "#id_profile" ).removeClass("form-control required");

                        $('#depto option[value="0"]').prop('selected',true);
                        $('#agencia option[value="0"]').prop('selected',true);
                        $('#content-agency').fadeOut('fast');
                    }
                }
            });

            //CAMBIOS DE PERFILES
            $('#id_profile').change(function(){
                $('#depto option[value="0"]').prop('selected',true);
                $('#agencia option[value="0"]').prop('selected',true);
                $('#content-agency').fadeOut('fast');
                alert($(this).prop('value'));
                var arrSlug = $(this).prop('value').split('|');
                if (arrSlug[1] == 'COP') {
                    //$('#product').removeClass('form-control requerid');
                    //$('#content-product').fadeOut('fast');
                    $.get("{{url('/')}}/admin/user/idcompany_ajax/" + arrSlug[0], function (data) {
                        //console.log(data);
                        $('#content-company').fadeIn('fast');
                        $('#id_company option').remove();
                        $('#id_company').addClass('form-control required');
                        $('#id_company').append('<option value="0">Seleccione</option>');
                        if (data.length > 0) {
                            $('#msg_company').html('');
                            $.each(data, function () {
                                //console.log("ID: " + this.id);
                                //console.log("First Name: " + this.name);
                                $('#id_company').append('<option value="' + this.id + '">' + this.name + '</option>');
                            });
                        } else {
                            $('#msg_company').html('<div class="alert alert-warning alert-styled-left"><span class="text-semibold"></span> No existen Compañías de Seguros<br><a href="{{route('admin.company.list', ['nav'=>'company', 'action'=>'list'])}}">Ingresar compañía de seguros</a></div>');
                        }
                    });

                }else if(arrSlug[1] == 'SEP'){
                    $('#id_company').removeClass('form-control required');
                    $('#content-company').fadeOut('fast');
                    $.get("{{url('/')}}/admin/user/idproduct_ajax/" + arrSlug[0], function(data){
                        $('#product').addClass('form-control required');
                        $('#content-product').fadeIn('fast');
                        $('#product option').remove();
                        if(data.length>0){
                            $.each(data, function () {
                                console.log("ID: " + this.id);
                                console.log("Product: " + this.name);
                                $('#product').append('<option value="'+this.id+'">'+this.name+'</option>');
                            });
                        }
                    });
                }else{
                    $('#id_company').removeClass('form-control required');
                    $('#content-company').fadeOut('fast');
                    //$('#product').removeClass('form-control requerid');
                    //$('#content-product').fadeOut('fast');
                }
            });

            //CONFIRMAR SI EXISTE CORREO ELECTRONICO
            $('#txtEmail').keyup(function(){
                var email = $(this).prop('value');
                var id_usuario = $('#id_user').prop('value');
                var regex = /^([a-z]+[a-z0-9._-]*)@{1}([a-z0-9\.]{2,})\.([a-z]{2,3})$/;
                if(regex.test(email)){

                    $.get( "{{url('/')}}/admin/user/find_email_edit_ajax/"+email+"/"+id_usuario, function( data ) {
                        //console.log(data);
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

            //VERIFICAMOS EL FORMULARIO
            $('#userUpdateForm').submit(function(e){
                var sw = true;
                var err = 'Esta informacion es obligatoria';
                $(this).find('.required, .not-required').each(function(index, element) {
                    //alert(element.type+'='+element.value);
                    if($(this).hasClass('required') === true){
                        if(validateElement(element,err) === false){
                            sw = false;
                        }
                    }
                });
                if(sw==true){

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

        });
    </script>
@endsection