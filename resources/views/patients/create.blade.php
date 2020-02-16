@extends('layouts.app2')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading shad">
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
                            <strong>Nuevo Paciente</strong>
                        </li>
                    </ol>
                </div>
</div><!-- END SECCION TITULO-->

<div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">

        <div class="ibox-content shad">
            <h4>Registrar nuevo paciente</h4>
            <div class="hr-line-dashed"></div>
            @if($errors->any())
                <div class="form-group">
                        @foreach($errors->all() as $error)
                            <p class="alert label-danger">{{$error}}</p>
                        @endforeach
                </div>
            @endif
            <form method="post" action="{{url('/patients')}}" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="col-sm-2 control-label">Sube una imagen</label>
                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                        <div class="form-control" data-trigger="fileinput">
                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                        <span class="fileinput-filename"></span>
                        </div>
                        <span class="input-group-addon btn btn-default btn-file">
                            <span class="fileinput-new">Select file</span>
                            <span class="fileinput-exists">Cambiar</span>
                            <input type="file" name="user_photo"/>
                        </span>
                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Quitar</a>
                    </div> 
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Nombre(s)</label>
                    <div class="col-sm-10"><input name="name" type="text" class="form-control" value="{{old('name')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Apellidos</label>
                    <div class="col-sm-10"><input name="lastName" type="text" class="form-control" value="{{old('lastName')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Edad</label>
                    <div class="col-sm-10"><input name="age" type="text" class="form-control" value="{{old('age')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Teléfono</label>
                    <div class="col-sm-10"><input name="telephone" type="number" min="0" class="form-control" value="{{old('telephone')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10"><input name="email" type="text" class="form-control" value="{{old('email')}}"></div>
                </div>

                <div class="hr-line-dashed"></div>
                <h5>Dirección</h5>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Calle</label>
                    <div class="col-sm-10"><input name="street" type="text" class="form-control"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Numero</label>
                    <div class="col-sm-10"><input name="number" type="text" class="form-control"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Colonia</label>
                    <div class="col-sm-10"><input name="colonia" type="text" class="form-control"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Codigo Postal</label>
                    <div class="col-sm-10"><input name="cp" type="text" class="form-control"></div>
                </div>

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-9">
                        <a class="btn btn-white" href="{{url('/patients')}}">Cancelar</a>
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                </div>

            
            </form>

        </div>


        </div><!--END CONTAINER ROW-->
</div><!--END WRAPER-->

@include('layouts/disablebutton')

@endsection