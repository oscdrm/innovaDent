@extends('layouts.app2')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
 <div class="row">
    <div class="col-lg-12">
        <div class="col-lg-6">
            <form action="{{url('/earning/calculate')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                            <p>Doctor</p>
                            <select data-placeholder="Selecciona una doctor" name="doctor" class="chosen-select shad"  tabindex="2">
                                <option value="">Selecciona un Doctor</option>
                                @foreach ($doctors as $doctor)
                                    @if(isset($doc) && $doc == $doctor->id)
                                        <option value="{{$doctor->id}}" selected>{{$doctor->name}} {{$doctor->lastName}}</option>
                                    @else
                                        <option value="{{$doctor->id}}">{{$doctor->name}} {{$doctor->lastName}}</option>
                                    @endif
                                @endforeach
                            </select>
                    </div>

                    <div class="col-md-6">
                        <p>Tratamiento</p>
                        <select data-placeholder="Selecciona un tratamiento" name="concept" class="chosen-select shad"  tabindex="2">
                            <option value="">Selecciona un concepto</option>
                            @foreach ($concepts as $concept)
                                @if(isset($conc) && $conc == $concept->id)
                                    <option value="{{$concept->id}}" selected>{{$concept->name}}</option>
                                @else
                                    <option value="{{$concept->id}}">{{$concept->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="filter">
                    <div class="form-group" id="data_5">
                        <label class="font-normal">Selecciona las fechas de corte</label>
                        <div class="input-daterange input-group shad" id="datepicker" val-valid="{{isset($vali) ? $vali : 0}}">
                            <span class="input-group-addon">Del </span>
                            <input type="text" class="input-sm form-control datepicker shad" value="{{isset($start) ? $start : ''}}" data-date-format="dd/mm/yyyy" name="start"/>
                            <span class="input-group-addon">al </span>
                            <input type="text" class="input-sm form-control datepicker" value="{{isset($end) ? $end : ''}}" data-date-format="dd/mm/yyyy" name="end"/>
                        </div>
                    </div>
                </div>               
               
                <div class="form-group">

                        <button id="filter" type="button" class="btn btn-w-m darkblue1-bg btn-info">Filtrar por fechas</button>
                        <button type="submit" class="btn btn-w-m darkblue2-bg btn-success">Realizar corte</button>
                        <button type="button" onclick="window.location='/earning/';"  class="btn btn-w-m darkblue3-bg btn-warning">Corte general</button>

                </div>

            </form>
        </div>

    </div>

    <div class="col-lg-12">

        <div class="col-lg-3">
            <div class="widget darkblue1-bg p-lg text-center shad">
                    <div class="m-b-md">
                        <span style="font-size:55px;">{{$serviciosRealizados}}</span>
                        <h3 class="font-bold no-margins">
                            Servicios Realizados
                        </h3>
                    </div>
                </div>
        </div>

        <div class="col-lg-4">
            <div class="widget darkblue2-bg p-lg text-center shad">
                    <div class="m-b-md">
                        <i class="fa fa-dollar fa-4x"></i> <span style="font-size:55px;">{{$amountWeek}}</span>
                        <h3 class="font-bold no-margins">
                            Corte General
                        </h3>
                    </div>
                </div>
        </div>

        <div class="col-lg-4">
            <div class="widget darkblue4-bg p-lg text-center shad">
                    <div class="m-b-md">
                        <i class="fa fa-dollar fa-4x"></i> <span style="font-size:55px;">{{$dineroCaja}}</span>
                        <h3 class="font-bold no-margins">
                            Dinero en caja
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
                    <table class="table table-striped table-bordered table-hover dataTables-example" data-page-size="15">
                        <thead>
                        <tr>
                            <th>N Movimiento</th>
                            <th>ID Consulta</th>
                            <th data-hide="phone">Paciente</th>
                            <th data-hide="phone">Costo</th>
                            <th data-hide="phone">Dia y Hora de consulta</th>
                            <th data-hide="phone,tablet" >Doctor</th>
                            <th data-hide="phone">Concepto</th>
                            <th data-hide="phone">Cobrada por</th>
                            <th data-hide="phone">Metodo de pago</th>
                            <th data-hide="phone">Sucursal:</th>
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

                                <td>
                                    {{$consult->cashier->username}}
                                </td>

                                <td>
                                    {{$consult->paymentMethod ? $consult->paymentMethod->name: ''}}
                                </td>
                                @if(auth()->user()->role->id == 1)
                                    <td>    
                                        <span class="actions-custom"><a class="yellow" href="{{url('/consults/'.$consult->id.'/edit')}}"> <i class="fa fa-edit yellow"></i>Editar </a></span>
                                        <form style="display:inline" method="post" action="{{url('/consults/'.$consult->id)}}">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button type="submit" title="Eliminar" class="red btn-custom"><i class="fa fa-times red"></i>Eliminar</button>
                                        </form>
                                    </td>
                                @endif

                                <td>
                                    {{$consult->surgery ? $consult->surgery->name: ''}}
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

 <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [],
                language: {
                    search: "Buscar en la tabla:",
                    info:   "Mostrando del _START_ al _END_ de _TOTAL_ registros",
                    lengthMenu:    "Mostrar _MENU_ registros",
                    infoFiltered:   "",
                    paginate: {
                        first:      "Primero",
                        previous:   "Anterior",
                        next:       "Siguiente",
                        last:       "Ultimo"
                    }
                }

            });

        });

    </script>

@endsection

@extends('saludo')
