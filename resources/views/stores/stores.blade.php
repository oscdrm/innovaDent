@extends('layouts.app2')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading shad">
                <div class="col-lg-9">
                    <h2>Tiendas</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{url('home')}}">Home</a>
                        </li>
                        <li class="active">
                            <strong>Tiendas</strong>
                        </li>
                    </ol>
                </div>
</div><!-- END SECCION TITULO-->

<div class="wrapper wrapper-content animated fadeInRight">

        <div class="ibox shad">
            <div class="ibox-title">
                <div class="ibox-tools">
                    <a href="{{url('/stores/create')}}" class="btn btn-primary btn-xs">Crear nueva tienda</a>
                </div>
            </div>
        </div> 

        <div class="row">
            @foreach($stores as $store)
                <div class="col-lg-3">
                    <div class="contact-box center-version shad">

                        <a href="profile.html">
                            <h3 class="m-b-xs"><strong>{{$store->name}}</strong></h3>
                            <address class="m-t-md">
                                <strong>Dirección</strong><br>
                                 <p>{{$store->address}}</p>
                               
                            </address>

                        </a>
                        <div class="contact-box-footer">
                            <div class="m-t-xs btn-group">
                                <a class="btn btn-xs btn-white">Ver</a>
                                <a href="{{url('/stores/'.$store->id.'/edit')}}" class="btn btn-xs btn-white">Editar</a>
                                <form style="display:inline" method="post" action="{{url('/stores/'.$store->id)}}">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button type="submit" title="Eliminar" class="btn btn-xs btn-white">Eliminar</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div><!--END COMPONENT-->
            @endforeach

            {{$stores->links()}}
        </div><!--END CONTAINER ROW-->
</div><!--END WRAPER-->

@endsection