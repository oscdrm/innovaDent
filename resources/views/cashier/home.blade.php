@extends('layouts.app2')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
 <div class="row">
    <div class="col-lg-12">
        <div class="col-lg-2">
           <a href="">
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
            <a href="">
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
                        <i class="fa fa-dollar fa-4x"></i> <span style="font-size:55px;">40</span>
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
                    @foreach ($consults as $consult)
                        <tr>
                            <td>
                               {{$consult->id}} 
                            </td>
                            <td>
                                {{$consult->patient->name}}
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
