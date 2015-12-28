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
            <h5 class="panel-title">Lista Compañía Aseguradora</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="company_new.html" class="btn btn-link btn-float has-text">
                            <i class="icon-calendar5 text-primary"></i>
                            <span>Agregar Compañia</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="panel-body">

        </div>

        <table class="table datatable-basic">
            <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Job Title</th>
                <th>DOB</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Marth</td>
                <td><a href="#">Enright</a></td>
                <td>Traffic Court Referee</td>
                <td>22 Jun 1972</td>
                <td><span class="label label-success">Active</span></td>
                <td class="text-center">
                    <ul class="icons-list">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="company_edit.html"><i class="icon-file-pdf"></i> Editar</a></li>
                                <li><a href="#"><i class="icon-file-excel"></i> Desactivar</a></li>
                            </ul>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td>Jackelyn</td>
                <td>Weible</td>
                <td><a href="#">Airline Transport Pilot</a></td>
                <td>3 Oct 1981</td>
                <td><span class="label label-default">Inactive</span></td>
                <td class="text-center">
                    <ul class="icons-list">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="company_edit.html"><i class="icon-file-pdf"></i> Editar</a></li>
                                <li><a href="#"><i class="icon-file-excel"></i> Desactivar</a></li>
                            </ul>
                        </li>
                    </ul>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection