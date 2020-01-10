@extends('layouts.app2')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Consultas</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{url('/home')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{url('/consults')}}">Consultas</a>
                        </li>
                        <li class="active">
                            <strong>Nueva Consulta</strong>
                        </li>
                    </ol>
                </div>
</div><!-- END SECCION TITULO-->

<div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">

        <div class="ibox-content">
            <h4>Registrar nueva consulta</h4>
            <div class="hr-line-dashed"></div>
            @if($errors->any())
                <div class="form-group">
                        @foreach($errors->all() as $error)
                            <p class="alert label-danger">{{$error}}</p>
                        @endforeach
                </div>
            @endif
            <form method="post" action="{{url('/consults')}}" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="col-sm-2 control-label">Paciente</label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona una tienda" name="patient" class="chosen-select"  tabindex="2">
                            <option value="">Selecciona un paciente</option>
                            @foreach ($patients as $patient)
                                <option value="{{$patient->id}}">{{$patient->name}} {{$patient->lastName}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Otro paciente</label>
                    <div class="col-sm-10"><input name="other_patient" type="text" class="form-control" value="{{old('address')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Doctor</label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona una tienda" name="doctor" class="chosen-select"  tabindex="2" required>
                            <option value="">Selecciona un Doctor</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{$doctor->id}}">{{$doctor->name}} {{$doctor->lastName}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Servicio</label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona una tienda" name="concept" class="chosen-select"  tabindex="2" required>
                            <option value="">Selecciona un servicio</option>
                            @foreach ($services as $service)
                                <option value="{{$service->id}}">{{$service->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label">Costo</label>
                    <div class="col-sm-10"><input name="amount" type="number" class="form-control" value="{{old('amount')}}"></div>
                </div>
                @if(auth()->user()->role->id == 1)
                    <div class="form-group" id="data_1">
                                    <label class="font-normal">Selecciona la fecha de consulta:</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="date-consult" name="date-consult" type="text" data-date-format="dd/mm/yyyy" class="form-control">
                                    </div>
                    </div>
                @endif


                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-9">
                        <a class="btn btn-white" href="{{url('/consults')}}">Cancelar</a>
                        <button class="btn btn-primary" type="submit">Cobrar</button>
                    </div>
                </div>

            
            </form>

        </div>


        </div><!--END CONTAINER ROW-->
</div><!--END WRAPER-->

@endsection