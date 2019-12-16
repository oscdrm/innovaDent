@extends('layouts.app2')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Pacientes</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{url('home')}}">Home</a>
                        </li>
                        <li class="active">
                            <strong>Pacientes</strong>
                        </li>
                    </ol>
                </div>
</div><!-- END SECCION TITULO-->

<div class="wrapper wrapper-content animated fadeInRight">

        <div class="ibox">
            <div class="ibox-title">
                <div class="ibox-tools">
                    <a href="{{url('/patients/create')}}" class="btn btn-primary btn-xs">Crear nuevo paciente</a>
                </div>
            </div>

            <div class="ibox-content">
                <div class="row m-b-sm m-t-sm">
                    
                    <div class="col-md-11">
                        <div class="input-group"><input type="text" placeholder="Introduce el nombre del paciente a buscar" class="input-sm form-control"> <span class="input-group-btn">
                            <button type="button" class="btn btn-sm btn-primary"> Buscar</button> </span></div>
                    </div>
                </div>
            </div>

        </div> 

        <div class="row">
            @foreach($patients as $patient)
                <div class="col-lg-3">
                    <div class="contact-box center-version">

                        <a href="profile.html">

                            <img alt="image" class="img-circle" src="{{$patient->user_photo ? asset($patient->user_photo) : asset('img/profile.jpg')}}">
                            <h3 class="m-b-xs"><strong>{{$patient->name}} {{$patient->lastName}}</strong></h3>
                            <div class="font-bold">{{$patient->email}}</div>
                            <address class="m-t-md">
                                <strong>Dirección</strong><br>
                                @if($patient->addresses->count() >= 1)
                                {{$patient->addresses->last()->street ? $patient->addresses->last()->street : ''}} {{$patient->addresses->last()->number ? $patient->addresses->last()->number : ''}} <br>
                                {{$patient->addresses->last()->colonia ? $patient->addresses->last()->colonia : ''}} <br>
                                {{$patient->addresses->last()->cp ? $patient->addresses->last()->cp : ''}}  
                                @endif
                                <br><abbr title="Phone"></abbr><i class="fa fa-phone"></i>  {{$patient->telephone}} 
                            </address>

                        </a>
                        <div class="contact-box-footer">
                            <div class="m-t-xs btn-group">
                                <a class="btn btn-xs btn-white">Perfil</a>
                                <a href="{{url('/patients/'.$patient->id.'/edit')}}" class="btn btn-xs btn-white">Editar</a>
                                <form style="display:inline" method="post" action="{{url('/patients/'.$patient->id)}}">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button type="submit" title="Eliminar" class="btn btn-xs btn-white">Eliminar</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div><!--END COMPONENT-->
            @endforeach

            {{$patients->links()}}
        </div><!--END CONTAINER ROW-->
</div><!--END WRAPER-->

@endsection