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
                <span class="form-wizard-count"><i class="icon-file-text2"></i></span>
                Editar Tasas
                <small class="display-block">Formulario</small>
            </h5>
            <div class="heading-elements">

            </div>
        </div>
        @if (session('error'))
            <div class="alert alert-danger alert-styled-left alert-bordered">
                <span class="text-semibold">Error!</span> {{ session('error') }}
            </div>
        @endif
        @var $cont = 0
        <div class="panel-body">

            {!! Form::open(array('route' => 'update_rates', 'name' => 'UpdateForm', 'id' => 'UpdateForm', 'method'=>'post', 'class'=>'form-horizontal', 'files' => true)) !!}
            @if($code_product=='de' || $code_product=='vi' || $code_product=='td')
                <fieldset class="content-group">
                    <div class="form-group">
                        <label class="control-label col-lg-2">Retailer </label>
                        <div class="col-lg-10">
                            <strong>{{$query->retailer}}</strong>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Producto </label>
                        <div class="col-lg-10">
                            <strong>{{$query->product}}</strong>
                        </div>
                    </div>

                    @if($type=='coverage')
                        <div class="form-group">
                            <label class="control-label col-lg-2">Coberturas </label>
                            <div class="col-lg-10">
                                <strong>{{$query->coverage}}</strong>
                            </div>
                        </div>
                    @endif
                    <!--
                    <div class="form-group">
                        <label class="control-label col-lg-2">Tasa Compañía <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control required decimal" name="rate_company" id="rate_company" value="{{$query->rate_company}}" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Tasa Banco <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control required decimal" name="rate_bank" id="rate_bank" value="{{$query->rate_bank}}" autocomplete="off">
                        </div>
                    </div>
                    -->

                    <div class="form-group">
                        <label class="control-label col-lg-2">Tasa Final</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control required decimal" name="rate_final" id="rate_final" value="{{$query->rate_final}}" autocomplete="off">
                        </div>
                    </div>

                </fieldset>
            @elseif($code_product=='au')
                <fieldset class="content-group">
                    <div class="form-group">
                        <label class="control-label col-lg-2">Retailer </label>
                        <div class="col-lg-10">
                            <strong>{{$retailer_product->retailer->name}}</strong>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Producto </label>
                        <div class="col-lg-10">
                            <strong>{{$retailer_product->companyProduct->product->name}}</strong>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Tasa Final <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control required decimal" name="rate_end" id="rate_end" value="{{$query_rate->rate_final}}" autocomplete="off">
                        </div>
                    </div>
                    @foreach($category_query as $data)
                        @var $cont=$cont+1
                        <div class="form-group">
                            <label class="control-label col-lg-2">Tasa Categoria {{substr($data->category, 1)}} <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control required decimal category" name="rate_category_{{$cont}}" id="rate_category_{{$cont}}" value="{{$data->increment}}" autocomplete="off" rel="{{$cont}}">
                                <input type="hidden" name="id-increment-{{$cont}}" value="{{$data->id_increment}}">
                            </div>
                        </div>
                    @endforeach
                    <input type="hidden" name="cont" value="{{$cont}}">
                </fieldset>
            @endif
            <div class="text-right">
                <button type="submit" class="btn btn-primary">
                    Guardar <i class="icon-floppy-disk position-right"></i>
                </button>
                <a href="{{route('admin.tasas.list', ['nav'=>'rate', 'action'=>'list', 'id_retailer_products'=>$id_retailer_products, 'code_product'=>$code_product, 'type'=>$type, 'type_product'=>$type_product])}}" class="btn btn-primary">
                    Cancelar <i class="icon-arrow-right14 position-right"></i>
                </a>
                <input type="hidden" name="id_rates" value="{{$id_rates}}">
                <input type="hidden" name="id_retailer_products" value="{{$id_retailer_products}}">
                <input type="hidden" name="code_product" value="{{$code_product}}">
                <input type="hidden" name="type" value="{{$type}}">
            </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){

            //REALIZAR SUMAS DE TASAS PARA EL RESULTADO TASA FINAL
            $('#rate_company').click(function(){
                $('#rate_company').prop('value', '');
            });
            $('#rate_company').keyup(function(){
                var rate_company = $('#rate_company').prop('value');
                var regex = /^([0-9\.])*$/;
                if(!(regex.test(rate_company))){
                    $('#rate_company').prop('value', '');
                }else{
                    var rate_bank = $('#rate_bank').prop('value');
                    var tasa_final = parseFloat(rate_company)+ parseFloat(rate_bank);
                    if(isNaN(tasa_final)){
                        $('#rate_final').prop('value', 0);
                    }else{
                        $('#rate_final').prop('value',tasa_final.toFixed(2));
                    }
                }
            });

            $('#rate_bank').click(function(){
                $('#rate_bank').prop('value', '');
            });
            $('#rate_bank').keyup(function(){
                var rate_bank = $('#rate_bank').prop('value');
                var regex = /^([0-9\.])*$/;
                if(!(regex.test(rate_bank))){
                    $('#rate_bank').prop('value', '');
                }else{
                    var rate_company = $('#rate_company').prop('value');
                    var tasa_final = parseFloat(rate_company)+ parseFloat(rate_bank);
                    if(isNaN(tasa_final)){
                        $('#rate_final').prop('value', 0);
                    }else{
                        $('#rate_final').prop('value',tasa_final.toFixed(2));
                    }
                }
            });

            $('#rate_end').click(function(){
                $('#rate_end').prop('value', '');
            });
            $('#rate_end').keyup(function(){
                var rate_bank = $('#rate_end').prop('value');
                var regex = /^([0-9\.])*$/;
                if(!(regex.test(rate_bank))){
                    $('#rate_end').prop('value', '');
                }
            });

            $('.category').click(function(){
                var rel = $(this).attr('rel');
                $('#rate_category_'+rel).prop('value', '');
            });
            $('.category').keyup(function(){
                var rel = $(this).attr('rel');
                var rate = $('#rate_category_'+rel).prop('value');
                var regex = /^([0-9\.])*$/;
                if(!(regex.test(rate))){
                    $('#rate_category_'+rel).prop('value', '');
                }
            });

            //VERIFICAMOS EL FORMULARIO
            $('#UpdateForm').submit(function(e){
                var sw = true;
                var err = 'Esta informacion es obligatoria';
                var code_product = $("input[name='code_product']").prop('value');

                $(this).find('.required, .not-required').each(function(index, element) {
                    //alert(element.type+'='+element.value);
                    if($(this).hasClass('required') === true){
                        if(validateElement(element,err,code_product) === false){
                            sw = false;
                        }else if(validateElementType(element,err,code_product) === false){
                            sw = false;
                        }
                    }else if($(this).hasClass('not-required') === true){
                        removeClassE(element);
                        if(validateElementType(element,err,code_product) === false){
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
            function validateElement(element,err,code_product){
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
                    if(code_product=='au'){
                        if(_value==''){
                            addClassE(element,err);
                            return false;
                        }else{
                            removeClassE(element,err);
                            return true;
                        }
                    }else{
                        if(_value==0){
                            err = 'Ingrese una tasa';
                            addClassE(element,err);
                            return false;
                        }else{
                            removeClassE(element,err);
                            return true;
                        }
                    }
                }
            }
            //ADICIONAMOS CLASE
            function addClassE(element,err){
                var _id = $(element).prop('id');
                //$(element).addClass('error-text');
                if(!$("#"+_id+" + .validation-error-label").length) {
                    $("#"+_id+":last").after('<label class="validation-error-label">'+err+'</label>');
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
                if($(element).hasClass('text') === true){
                    regex = /^[a-zA-ZáÁéÉíÍóÓúÚñÑüÜ\s]*$/;
                    err = 'Ingrese solo texto';
                }else if($(element).hasClass('decimal') === true){
                    regex = /^([0-9\.])*$/;
                    err = 'Ingrese solo numeros enteros o numeros decimales';
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