@extends('layout')

@section('header')
@include('partials.header-home')
@endsection

@section('menu-main')
@include('partials.menu-main')
@endsection

@section('menu-header')
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Automotores</span></h4>
            <ul class="breadcrumb breadcrumb-caret position-right">
                <li><a href="">Inicio</a></li>
                <li class="active">Reporte Solicitud</li>
            </ul>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-flat border-top-primary">
            <div class="panel-heading">
                <h6 class="form-wizard-title2 text-semibold">
                    <span class="col-md-12">
                        <span class="form-wizard-count">R</span>
                        Reportes
                        <small class="display-block">Listado</small>
                    </span>
                </h6>
            </div>
            <div class="panel-body">
                <div class="tabbable">
                    <!--<ul class="nav nav-tabs nav-tabs-highlight nav-justified">-->
                    <ul class="nav nav-tabs nav-tabs-highlight">
                        <li>
                            <a href="{{ route('report.auto_report_general',[ 'id_comp' => $id_comp ]) }}">General</a>
                        </li>
                        <li>
                            <a href="{{ route('report.auto_report_general_emitido',[ 'id_comp' => $id_comp ]) }}">P&oacute;lizas Emitidas</a>
                        </li>
                        <li class="active">
                            <a href="{{ route('report.auto_report_cotizacion',[ 'id_comp' => $id_comp ]) }}">Solicitudes</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        
                <div class="col-xs-12 col-md-12">
                    <form class="form-horizontal form-validate-jquery" action="" id="form_search_general">
                        {!! Form::open(['route' => ['report.auto_report_cotizacion_result','id_comp'=>$id_comp], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                        <div class="panel-body ">
                            @include('report.partials.inputs-cotizacion',
                            array(
                            'valueForm' => $valueForm,
                            'users' => $users,
                            'cities' => $cities,
                            'agencies' => $agencies,
                            'extencion' => $extencion,
                            'report' => 'au' 
                            ))
                            <div class="col-xs-12 col-md-3">
                                <div class="text-right">
                                    <a href="{{ route('report.auto_report_cotizacion',['id_comp'=>$id_comp]) }}" class="btn btn-default" title="Cancelar">Cancelar <i class="icon-cross2 position-right"></i></a>
                                    <button type="submit" class="btn btn-primary" id="buscar" onclick="$('#xls_download').val(0);">Buscar <i class="icon-search4 position-right"></i></button>
                                </div>
                            </div>

                        </div>
                        <hr />
                        {!! Form::close() !!}
                </div>
                <div class="col-xs-12 col-md-12">  
                    @if (count($result)>0)
                    <div class="panel panel-flat">  
                        <div class="col-xs-12 col-md-12">
                            <div class="text-right">
                                <br />
                                <a onclick="$('#xls_download').val(1); $('#form_search_general').submit();">
                                    <img src="{{ asset('images/xls2.png') }}" alt="descargar" />
                                </a>
                            </div>
                        </div>
                        <table class="table datatable-fixed-left_order_false table-striped" width="100%">
                            <thead>
                                <tr style="background-color: #337ab7" class="text-white">
                                    <th>Nro. Cotizaci&oacute;n</th>
                                    <th>Cliente</th>
                                    <th>CI</th>
                                    <th>Ciudad</th>
                                    <th>G&eacute;nero</th>
                                    <th>Plazo de Cr&eacute;dito</th>
                                    <th>Forma de Pago</th>
                                    <th>Nro. Credito</th>
                                    <th>Usuario</th>
                                    <th>Sucursal Reg&iacute;stro</th>
                                    <th>Agencia</th>
                                    <th>
                            <div class="container">
                                        <div class="col-xs-12">
                                            <!--<div class="col-lg-12">Auto</div>-->
                                            <div class="col-lg-5">Modelo</div>
                                            <div class="col-lg-2">Año</div>
                                            <div class="col-lg-3">Placa</div>
                                            <div class="col-lg-1">0 Km.</div>
                                            <div class="col-lg-1">Valor Asegurado</div>
                                        </div>   
                                </div>
                                    </th>
                            <th>Acci&oacute;n</th>

                            </tr>
                            </thead>
                            <tbody>
                                @var $sum = 1
                                @foreach($result as $entities)
                                <tr>
                                    <td><strong>{{ $entities->nro_cotizacion }}</strong></td>
                                    <td>{{ $entities->cliente }}</td>
                                    <td>{{ $entities->ci }}</td>
                                    <td>{{ $entities->ciudad }}</td>
                                    <td>{{ $entities->genero }}</td>
                                    <td>{{ $entities->plazo_de_credito }}</td>
                                    <td>{{ $entities->forma_de_pago }}</td>
                                    <td>{{ $entities->numero_credito }}</td>
                                    <td>{{ $entities->usuario }}</td>
                                    <td>{{ $entities->sucursal_registro }}</td>
                                    <td>{{ $entities->agencia }}</td>
                                    <td class="col-md-12 col-xs-12" style="width: 700px !important;">
                                        @foreach($entities->auDetail as $detail)
                                        <div class="container">    
                                            <div class="col-xs-12 text-center">
                                                <div class="col-lg-5 text-left"> {{ $detail->vehicleModel->model }}</div>
                                                <div class="col-lg-2">{{ $detail->year }}</div>
                                                <div class="col-lg-3">{{ $detail->license_plate }}</div>
                                                <div class="col-lg-1">{{ $detail->mileage==1?'SI':'NO' }}</div>
                                                <div class="col-lg-1">{{ $detail->insured_value }} {{$entities->moneda}}</div>
                                            </div>
                                        </div>    
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <ul class="icons-list">
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li>
                                                        <a href="{{route('create_modal_slip', ['id_retailer_product'=>$id_comp, 'id_header'=>encode($entities->id), 'text'=>'slip', 'type'=>'IMPR'])}}"
                                                           id="issuance" class="open_modal">
                                                            <i class="icon-plus2"></i> Ver Slip de Cotización
                                                        </a>
                                                    </li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                @var $sum++
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <h1>No existen resultados.</h1>
                    @endif
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal -->
@include('partials.modal_content_report')
<!-- /modal -->

@endsection
