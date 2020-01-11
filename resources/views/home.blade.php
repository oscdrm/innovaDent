@extends('layouts.app2')

@section('content')
<section>
 <div class="row">
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-success pull-right">Diario</span>
                <h5>Fecha de Hoy</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">{{$nct}}</h1>
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
                <h1 class="no-margins">{{$ncw}}</h1>
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
                <h1 class="no-margins">{{$ncm}}</h1>
                <!--<div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>-->
                <medium>Personas atendidas</medium>
            </div>
        </div>
    </div>

</div>
</section>

<div class="wrapper wrapper-content animated fadeInRight">
 <div class="row">
    <div class="col-lg-12">
        <div class="col-lg-2">
           <a href="{{url('/patients/create')}}">
                <div class="widget lazur-bg p-lg text-center">
                    <div class="m-b-md">
                        <i style="margin-bottom:5px;" class="fa fa-user-o fa-4x"></i>
                        <h3 class="font-bold no-margins">
                            Nuevo Paciente
                        </h3>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-2">
            <a href="{{url('/consults/create')}}">
                <div class="widget yellow-bg p-lg text-center">
                    <div class="m-b-md">
                        <i style="margin-bottom:5px;" class="fa fa-stethoscope fa-4x"></i>
                        <h3 class="font-bold no-margins">
                            Nueva Consulta
                        </h3>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-lg-4">
            <div class="widget navy-bg p-lg text-center">
                    <div class="m-b-md">
                        <i class="fa fa-dollar fa-4x"></i> <span style="font-size:55px;">{{$amountToday}}</span>
                        <h3 class="font-bold no-margins">
                            Corte del dia
                        </h3>
                    </div>
                </div>
        </div>

        <div class="col-lg-4">
            <div class="widget blue-bg p-lg text-center">
                    <div class="m-b-md">
                        <i class="fa fa-dollar fa-4x"></i> <span style="font-size:55px;">{{$amountWeek}}</span>
                        <h3 class="font-bold no-margins">
                            Corte de la semana
                        </h3>
                    </div>
                </div>
        </div>

            
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">
             <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Consultas Recientes</h2>
                </div>
            </div>
    
                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                    <thead>
                    <tr>
                        <th>N Consulta</th>
                        <th>ID Consulta</th>
                        <th data-hide="phone">Paciente</th>
                        <th data-hide="phone">Costo</th>
                        <th data-hide="phone">Dia y Hora de consulta</th>
                        <th data-hide="phone,tablet" >Doctor</th>
                        <th data-hide="phone">Servicio</th>
                        <!--<th class="text-right">Action</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $c = 0;
                    @endphp
                    @foreach ($consults as $consult)
                        @php
                            $c++;
                        @endphp
                        <tr>
                            <td>
                               {{$c}} 
                            </td>
                            <td>
                               {{$consult->id}} 
                            </td>
                            <td>
                                {{$consult->patient ? $consult->patient->name : $consult->other_patient}} {{$consult->patient ? $consult->patient->lastName : ''}}
                            </td>
                            <td>
                                {{$consult->amount}}
                            </td>
                            <td>
                                {{$consult->created_at}}
                            </td>
                            <td>
                                {{$consult->doctor->name}}
                            </td>
                            <td>
                                {{$consult->concept->name}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@extends('saludo')
