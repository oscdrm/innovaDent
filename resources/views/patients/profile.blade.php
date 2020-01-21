@extends('layouts.app2')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Pacientes</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{url('/home')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{url('/patients')}}">Pacientes</a>
                        </li>
                        <li class="active">
                            <strong>Perfil de paciente</strong>
                        </li>
                    </ol>
                </div>
</div><!-- END SECCION TITULO-->

<div class="wrapper wrapper-content animated fadeInRight">


            <div class="row m-b-lg m-t-lg">
                <div class="col-md-6">

                    <div class="profile-image">
                        <img src="{{$patient->user_photo ? asset($patient->user_photo) : asset('img/profile.jpg')}}" class="img-circle circle-border m-b-md" alt="profile">
                    </div>
                    <div class="profile-info">
                        <div class="">
                            <div>
                                <h2 class="no-margins">
                                    {{$patient->name}} {{$patient->lastName}}
                                </h2>
                                <small>
                                    Teléfono: {{$patient->telephone}} <br>
                                    Teléfono 2: <br>
                                    Email: <br>
                                    Dirección:
                                     @php
                                       if($add){
                                           echo $add->street.' '.$add->number.' '.$add->colonia.' '.$add->cp;
                                       }
                                     @endphp
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <a href="{{url('/patients/create')}}">
                        <div class="widget lazur-bg p-lg text-center">
                            <div class="m-b-md">
                                <i style="margin-bottom:5px;" class="fa fa-user-o fa-4x"></i>
                                <h3 class="font-bold no-margins">
                                    Nueva Cita
                                </h3>
                            </div>
                        </div>
                    </a>      
                </div>

                <div class="col-md-3" id="new-treatment" data-toggle="modal" data-target="#myModal">
                        <div class="widget navy-bg p-lg text-center">
                            <div class="m-b-md">
                                <i style="margin-bottom:5px;" class="fa fa-user-o fa-4x"></i>
                                <h3 class="font-bold no-margins">
                                    Nuevo Tratamiento
                                </h3>
                            </div>
                        </div>     
                </div>


            </div>
            <div class="row">

                <div class="col-lg-7">
                        <div class="ibox">
                            <div class="ibox-content">
                            <div class="row wrapper border-bottom white-bg page-heading">
                                <div class="col-lg-9">
                                    <h2>Listado de Tratamientos</h2>
                                </div>
                            </div>
                    
                                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                    <thead>
                                    <tr>
                                        <th>ID Tratamiento</th>
                                        <th data-hide="phone">Paciente</th>
                                        <th data-hide="phone">Doctor</th>
                                        <th data-hide="phone">Tipo de tratamiento</th>
                                        <th data-hide="phone,tablet" >Numero de Sesiones</th>
                                        <th data-hide="phone">Status</th>
                                        <!--<th class="text-right">Action</th>-->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <tr>
                                            <td>
                                            
                                            </td>
                                            <td>
                                                
                                            </td>
                                            <td>
                                                
                                            </td>
                                            <td>
                                               
                                            </td>
                                            <td>
                                               
                                            </td>
                                            <td>
                                                
                                            </td>
                                        </tr>
                                       
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    

                        <div class="ibox">
                            <div class="ibox-content">
                            <div class="row wrapper border-bottom white-bg page-heading">
                                <div class="col-lg-9">
                                    <h2>Consultas recientes</h2>
                                </div>
                            </div>
                    
                                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                    <thead>
                                    <tr>
                                        <th>ID Tratamiento</th>
                                        <th data-hide="phone">Paciente</th>
                                        <th data-hide="phone">Doctor</th>
                                        <th data-hide="phone">Tipo de tratamiento</th>
                                        <th data-hide="phone,tablet" >Numero de Sesiones</th>
                                        <th data-hide="phone">Status</th>
                                        <!--<th class="text-right">Action</th>-->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <tr>
                                            <td>
                                            
                                            </td>
                                            <td>
                                                
                                            </td>
                                            <td>
                                                
                                            </td>
                                            <td>
                                               
                                            </td>
                                            <td>
                                               
                                            </td>
                                            <td>
                                                
                                            </td>
                                        </tr>
                                       
                                    </tbody>
                                </table>

                            </div>
                        </div>
                </div>
                <!-- INICIO TRATAMIENTOS-->
                <div class="col-lg-5">
                    <!-- Tratamiento -->
                    <div class="social-feed-box">
                        <div class="social-avatar">
                            <div class="media-body">
                                <h3>Tratamiento de Brackets</h3>
                                <small class="text-muted">Fecha de Inicio: 4:21 pm - 12.06.2014</small>
                            </div>
                        </div>
                        <div class="social-body">
                            
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <small class="stats-label">Tratamiento</small>
                                        <h4>Endodoncia</h4>
                                    </div>

                                    <div class="col-xs-4">
                                        <small class="stats-label">Doctor</small>
                                        <h4>Nora</h4>
                                    </div>
                                    <div class="col-xs-4">
                                        <small class="stats-label">Numero de Sesiones</small>
                                        <h4>10</h4>
                                    </div>
                                    <div class="col-xs-4">
                                        <small class="stats-label">Costo Total</small>
                                        <h4>$500</h4>
                                    </div>
                                    <div class="col-xs-4">
                                        <small class="stats-label">Sesiones</small>
                                        <h4>3</h4>
                                    </div>

                                    <div class="col-xs-4">
                                        <small class="stats-label">Pago</small>
                                        <h4>$400</h4>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="social-footer">
                            <div class="social-comment">
                               
                                <div class="ibox-content">
                                    <div class="row">
                                    
                                        <div class="pull-left">
                                            <button type="button" class="btn btn-info m-r-sm">1</button>
                                        </div>

                                         <div class="col-xs-4">
                                            <small class="stats-label">Abono</small>
                                            <h4>$ 400</h4>
                                        </div>

                                         <div class="col-xs-4">
                                            <small class="stats-label">Fecha</small>
                                            <h4>12/05/2019 18:04</h4>
                                        </div>

                                    </div>


                                    <div class="social-comment">
                                        <a href="" class="pull-left">
                                            <img alt="image" src="/img/profile.jpg">
                                        </a>
                                        <div class="media-body">
                                            <a href="#">
                                                Dr Neftaly
                                            </a>
                                                Se realizo limpieza, se detecto caries profunda
                                            <br/>
                                            <small class="text-muted">10.07.2014</small>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="social-footer" style="overflow:hidden;">
                               <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">Nueva sesión</button>
                        </div>

                        

                    </div><!-- End Tratamiento-->

                    <!-- Historia Clinica -->
                    <div class="social-feed-box">
                        <div class="social-avatar">
                            <div class="media-body">
                                <h3>Historia Clinica</h3>
                                <!--<small class="text-muted">Fecha de Inicio: 4:21 pm - 12.06.2014</small>-->
                            </div>
                        </div>
                        <div class="social-body">
                            
                            <div class="ibox-content">

                                <div class="social-comment">
                                        <a href="" class="pull-left">
                                            <img alt="image" src="/img/.jpg">
                                        </a>
                                        <div class="media-body">
                                            <a href="#">
                                                Dr Neftaly
                                            </a>
                                                Paciente con problema Maxilofacial, necesita programr cirugia
                                            <br/>
                                            <small class="text-muted">10.07.2014</small>
                                        </div>
                                    </div>

                            </div>

                        </div>
                        <div class="social-footer">
                            <div class="social-comment">
                               
                                    <div class="chat-form">
                                        <form role="form">
                                            <div class="form-group">
                                                <textarea class="form-control" placeholder="Mensaje"></textarea>
                                            </div>
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-sm btn-primary m-t-n-xs"><strong>Guardar Mensaje</strong></button>
                                            </div>
                                        </form>
                                    </div>
                                
                            </div>

                        </div>

                    </div><!-- End historia clinica-->

                </div>


            <!-- The Modal -->
            <div class="modal fade" id="myModal">
                <div class="modal-dialog modal-lg">
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h2 class="modal-title"></h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                        Modal body..
                    </div>
                    
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                    
                </div>
                </div>
            </div>

 

        </div>

@endsection

@section('additional_scripts')

    <script src="{{asset('js/ajax/profile.js')}}"></script>

@endsection