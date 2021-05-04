@extends('layouts.app2')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading shad">
            <div class="col-lg-9">
                <h2>Consultas</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{url('home')}}">Home</a>
                    </li>
                    <li class="active">
                        <strong>Consultas</strong>
                    </li>
                </ol>
            </div>
    </div><!-- END SECCION TITULO-->

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox shad">
        <div class="ibox-title">
            <div class="ibox-tools">
                <a href="{{url('/consults/create')}}" class="btn btn-primary btn-xs">Crear nueva consulta</a>
            </div>
        </div>
    </div> 

    <div class="row">
        <div class="col-lg-12">
            <!--<form role="search" class="shad" method="POST" action="{{url('/consults/search')}}">
                @csrf
                <div class="form-group">
                    <div class="col-lg-9"> 
                        <input type="text" placeholder="Buscar movimiento" class="form-control" name="filter" id="top-search">
                    </div>

                    <div class="col-lg-3 buscar"> 
                        <button class="btn btn-primary" type="submit">Buscar</button>
                    </div>
                </div>
            </form>-->
        </div>
    </div>

    <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
                    <div class="ibox float-e-margins shad">
                        <div class="ibox-title">
                            <h5>Listado de Consultas</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>N consulta</th>
                                        <th>ID Consulta</th>
                                        <th>Paciente</th>
                                        <th>Costo</th>
                                        <th>Dia y Hora de consulta</th>
                                        <th>Doctor</th>
                                        <th>Servicio</th>
                                        <th>Cajero</th>
                                        <th>Metodo de Pago</th>
                                        @if(auth()->user()->role->id == 1)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $c = 0;
                                        @endphp
                                        @foreach ($consults as $consult)
                                            @php
                                                $c++;
                                                $i = 0;
                                                $class = "";
                                                if($i%2 == 0){
                                                 	$class = "even";
                                                } else {
                                                    $class = "odd";
                                                }

                                                $dismount = "";
                                                $minus = "";
                                                if($consult->dismount == 1){
                                                    $class = "dismount";
                                                    $minus = "-";
                                                }

                                            @endphp   
                                            <tr class="{{$class}}">
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
                                                    {{$consult->doctor ? $consult->doctor->name : ''}}
                                                    {{$consult->doctor ? $consult->doctor->lastName : ''}} 
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
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="ibox-tools">
                                    <div class="pagination">

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div><!--END ROW-->

</div><!--END WRAPER-->
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