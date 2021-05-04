@extends('layouts.app2')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading shad">
            <div class="col-lg-9">
                <h2>Servicios</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{url('home')}}">Home</a>
                    </li>
                    <li class="active">
                        <strong>Servicios</strong>
                    </li>
                </ol>
            </div>
    </div><!-- END SECCION TITULO-->

<div class="wrapper wrapper-content animated fadeInRight">
        <div class="ibox shad">
            <div class="ibox-title">
                <div class="ibox-tools">
                    <a href="{{url('/concepts/create')}}" class="btn btn-primary btn-xs">Crear nuevo servicio</a>
                </div>
            </div>
        </div> 
    <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
                    <div class="ibox float-e-margins shad">
                        <div class="ibox-title">
                            <h5>Listado de Servicios</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Monto</th>
                                        <th>Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($concepts as $concept)
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
                                                <td>{{$concept->name}}</td>
                                                <td>{{$concept->amount}}</td>
                                                <td>    
                                                    <span class="actions-custom"><a class="yellow" href="{{url('/concepts/'.$concept->id.'/edit')}}"> <i class="fa fa-edit yellow"></i>Editar </a></span>
                                                    <form style="display:inline" method="post" action="{{url('/concepts/'.$concept->id)}}">
                                                        @csrf
                                                        {{method_field('DELETE')}}
                                                        <button type="submit" title="Eliminar" class="red btn-custom"><i class="fa fa-times red"></i>Eliminar</button>
                                                    </form>
                                                    
                                                </td>
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