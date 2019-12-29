@extends('layouts.app2')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
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
        <div class="ibox">
            <div class="ibox-title">
                <div class="ibox-tools">
                    <a href="{{url('/consults/create')}}" class="btn btn-primary btn-xs">Crear nueva consulta</a>
                </div>
            </div>
        </div> 
    <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Listado de Consultas</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID Consulta</th>
                                        <th>Paciente</th>
                                        <th>Costo</th>
                                        <th>Dia y Hora de consulta</th>
                                        <th>Doctor</th>
                                        <th>Servicio</th>
                                        <th>Cajero</th>
                                        @if(auth()->user()->role->id == 1)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($consults as $consult)
                                            @php
                                                $i = 0;
                                                $class = "";
                                                if($i%2 == 0){
                                                 	$class = "even";
                                                } else {
                                                    $class = "odd";
                                                }
                                            @endphp   
                                            <tr class="{{$class}}">
                                                <td>
                                                    {{$consult->id}} 
                                                </td>
                                                <td>
                                                    {{$consult->patient->name}} {{$consult->patient->lastName}}
                                                </td>
                                                <td>
                                                    {{$consult->amount}}
                                                </td>
                                                <td>
                                                    {{$consult->created_at}}
                                                </td>
                                                <td>
                                                    {{$consult->doctor->name}} {{$consult->doctor->lastName}}
                                                </td>
                                                <td>
                                                    {{$consult->concept->name}}
                                                </td>

                                                <td>
                                                    {{$consult->cashier->name}} {{$consult->cashier->lastName}}
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

@endsection