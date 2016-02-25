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
                <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Seguro de Desgravamen</span></h4>

                <ul class="breadcrumb breadcrumb-caret position-right">
                    <li><a href="">Inicio</a></li>
                    <li><a href="">Desgravamen</a></li>
                    <li class="active">Cotizar</li>
                </ul>
            </div>

        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal form -->
            <div class="panel panel-flat border-top-primary">
                <div class="panel-heading divhr">
                    <div class="steps-basic2 wizard">
                        <div class="steps">
                            <ul>
                                <li class="first done">
                                    <a href="#">
                                        <span class="number">1</span> Datos del Prestamo
                                    </a>
                                </li>
                                <li class="first done">
                                    <a href="#">
                                        <span class="number">2</span>Datos del Titular
                                    </a>
                                </li>
                                <li class="current">
                                    <a href="#">
                                        <span class="current-info audible">current step: </span>
                                        <span class="number">3</span> Resultado Cotización
                                    </a>
                                </li>
                                <li class="disabled last" >
                                    <a href="#">
                                        <span class="number">4</span> Emisión de la Póliza de Desgravamen
                                    </a>
                                </li>
                                <li class="disabled last">
                                    <a href="#">
                                        <span class="number">5</span> Impresión de la Póliza
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                        <button style="float: right;" type="button" class="btn btn-rounded btn-default text-right" title="Detalle de producto" data-placement="right" data-toggle="modal" data-target="#modal_theme_primary">
                            <i class="icon-question7"></i> Producto
                        </button>
                </div>
                <div class="clearfix"></div>

                @if(session('error_header'))
                    <div class="alert bg-danger alert-styled-right">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                        <span class="text-semibold">{{ session('error_header') }}</span>.
                    </div>
                @endif

                <div class="panel-body ">
                  <div class="col-xs-12 col-md-12">
                    @if($retailerProduct->companyProduct->product->code == 'de' && $retailerProduct->type == 'MP')
                      @foreach ($retailerProduct->rates as $rate)
                        @if ($rate->ad_coverage_id === $header->ad_coverage_id)
                          <div class="col-md-4 ">
                            <div class="panel panel-body border-top-primary text-center">
                              <div class="form-group">
                                {!! Html::image($retailerProduct->companyProduct->company->image, null, ['style' => 'max-height: 130px;']) !!}
                              </div>
                              <h6 class="no-margin text-semibold">Tasa del prestamo:</h6>
                              <p class="text-muted content-group-sm">{{ $rate->rate_final }}%</p>
                              <a href="#" onclick="cargaModal({{decode($header_id)}},'{{ Session::token() }}', 'slip', 'POST', 'cotizacion')" data-toggle="modal" data-target="#modal_general" class="btn btn-success">
                                <i class="icon-file-check position-left"></i>  Ver Cotización
                              </a>
                              <hr>
                              {!! Form::open(['route' => ['de.store.result',  'rp_id' => $rp_id, 'header_id' => $header_id], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                              {!! Form::hidden('rate_id', encrypt($rate->id)) !!}

                              {!! Form::button('<i class="icon-arrow-right14 position-left"></i> Emitir', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}

                              {!! Form::close() !!}
                            </div>
                          </div>
                        @endif
                      @endforeach
                    @endif
                  </div>
                </div>

                <!-- /horizotal form -->
            </div>
        </div>
    </div>

<!-- modal -->
@include('partials.modal')
<!-- /modal -->

@endsection
