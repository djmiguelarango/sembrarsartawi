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
                Parametros - Vida en Grupo
                <small class="display-block">Listado de registros</small>
            </h5>
            <div class="heading-elements">

            </div>
        </div>

        <div class="panel-body">

        </div>
        @if(count($query)>0)
            <table class="table datatable-basic">
            <thead>
            <tr>
                <th style="text-align: center;">Facturación</th>
                <th style="text-align: center;">Certificado Provisional</th>
                <th style="text-align: center;">Modalidad</th>
                <th style="text-align: center;">Facultativo</th>
                <th style="text-align: center;">Web Service</th>
                <th style="text-align: center;">Parametros Adicionales</th>
                <th style="text-align: center;">Estado</th>
                <th class="text-center">Acción</th>
            </tr>
            </thead>
            <tbody>
            @foreach($query as $data)
                <tr>
                    <td style="text-align: center;">
                        @if((boolean)$data->billing == true)
                            Si
                        @else
                            No
                        @endif
                    </td>
                    <td style="text-align: center;">
                        @if((boolean)$data->provisional_certificate == true)
                            Si
                        @else
                            No
                        @endif
                    </td>
                    <td style="text-align: center;">
                        @if((boolean)$data->modality == true)
                            Si
                        @else
                            No
                        @endif
                    </td>
                    <td style="text-align: center;">
                        @if((boolean)$data->facultative == true)
                            Si
                        @else
                            No
                        @endif
                    </td>
                    <td style="text-align: center;">
                        @if((boolean)$data->ws == true)
                            Si
                        @else
                            No
                        @endif
                    </td>
                    <td style="text-align: center;">
                        <a href="{{route('admin.vi.parameters.list-parameter-additional', ['nav'=>'vi', 'action'=>'list_parameter_additional', 'id_retailer_product'=>$id_retailer_product])}}">Agregar/Modificar Parametros</a>
                    </td>
                    <td>
                        @if((boolean)$data->active == true)
                            <span class="label label-success">Activo</span>
                        @else
                            <span class="label label-default">Inactivo</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="{{route('admin.vi.parameters.edit', ['nav'=>'vi', 'action'=>'edit', 'id_retailer_product'=>$id_retailer_product])}}">
                                            <i class="icon-pencil3"></i> Editar
                                        </a>
                                    </li>
                                    <li>
                                        @if((boolean)$data->active == true)
                                            <a href="#"><i class="icon-cross"></i> Desactivar</a>
                                        @elseif((boolean)$data->active == false)
                                            <a href="#"><i class="icon-checkmark4"></i> Activar</a>
                                        @endif
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
            <div class="alert alert-warning alert-styled-left">
                <span class="text-semibold">Warning!</span> No existe ningun registro, ingrese un nuevo registro.
            </div>
        @endif
    </div>
@endsection