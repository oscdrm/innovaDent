@extends('layouts.app2')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
 <div class="row">
    <div class="col-lg-12">
        <div class="col-lg-4">
            <form action="{{url('/earning/calculate')}}" method="post">
                @csrf
                <div class="form-group" style="margin-bottom:35px">
                    <div style="padding:10px 0px;">
                        <label class="col-lg-2 control-label">Doctor</label>
                        <div class="col-sm-10">
                            <select data-placeholder="Selecciona una tienda" name="doctor" class="chosen-select shad"  tabindex="2">
                                <option value="">Selecciona un Doctor</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{$doctor->id}}">{{$doctor->name}} {{$doctor->lastName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="filter">
                    <div class="form-group" id="data_5">
                        <label class="font-normal">Selecciona las fechas de corte</label>
                        <div class="input-daterange input-group shad" id="datepicker">
                            <span class="input-group-addon">Del</span>
                            <input type="text" class="input-sm form-control datepicker shad" data-date-format="dd/mm/yyyy" name="start"/>
                            <span class="input-group-addon">al</span>
                            <input type="text" class="input-sm form-control datepicker" data-date-format="dd/mm/yyyy" name="end"/>
                        </div>
                    </div>
                </div>               
               
                <div class="form-group">

                        <button id="filter" type="button" class="btn btn-w-m btn-info">Filtrar por fechas</button>
                        <button type="submit" class="btn btn-w-m btn-success">Realizar corte</button>
                        <button type="button" onclick="window.location='/earning/';"  class="btn btn-w-m btn-warning">Corte general</button>

                </div>

            </form>
        </div>


        <div class="col-lg-4">
            <div class="widget navy-bg p-lg text-center shad">
                    <div class="m-b-md">
                        <span style="font-size:55px;">{{$serviciosRealizados}}</span>
                        <h3 class="font-bold no-margins">
                            Servicios Realizados
                        </h3>
                    </div>
                </div>
        </div>

        <div class="col-lg-4">
            <div class="widget blue-bg p-lg text-center shad">
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
            <div class="ibox-content shad">
             <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Movimientos consultados</h2>
                </div>
            </div>
                <div class="table-responsive">
                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                        <thead>
                        <tr>
                            <th>N Movimiento</th>
                            <th>ID Consulta</th>
                            <th data-hide="phone">Paciente</th>
                            <th data-hide="phone">Costo</th>
                            <th data-hide="phone">Dia y Hora de consulta</th>
                            <th data-hide="phone,tablet" >Doctor</th>
                            <th data-hide="phone">Concepto</th>
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
                            $dismount = "";
                            $minus = "";
                            if($consult->dismount == 1){
                                $dismount = "dismount";
                                $minus = "-";
                            }
                        @endphp
                            <tr class="{{$dismount}}">
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
                                    {{$minus}}{{$consult->amount}}
                                </td>
                                <td>
                                    {{$consult->created_at}}
                                </td>
                                <td>
                                    {{$consult->doctor ? $consult->doctor->name : ''}} {{$consult->doctor ? $consult->doctor->lastName : ''}}
                                </td>
                                <td>
                                    {{$consult->concept ? $consult->concept->name : $consult->other_concept}}
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
</div>

@endsection

@extends('saludo')
