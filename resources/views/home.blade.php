@extends('layouts.app2')

@section('content')
 <div class="row">
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-success pull-right">Diario</span>
                <h5>Fecha de Hoy</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">24</h1>
                <!--<div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>-->
                <medium>Personas atendidas</medium>
            </div>
        </div>
    </div>

     <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-info pull-right">Semanal</span>
                <h5>Semana</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">24</h1>
                <!--<div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>-->
                <medium>Personas atendidas</medium>
            </div>
        </div>
    </div>

     <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-primary pull-right">Mensual</span>
                <h5>Mes Actual</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">24</h1>
                <!--<div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>-->
                <medium>Personas atendidas</medium>
            </div>
        </div>
    </div>

</div>
@endsection
