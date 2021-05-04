@extends('layouts.app2')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading shad">
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
                            <strong>Editar Consulta</strong>
                        </li>
                    </ol>
                </div>
</div><!-- END SECCION TITULO-->

<div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">

        <div class="ibox-content shad">
            <h4>Editar consulta</h4>
            <div class="hr-line-dashed"></div>
            @if($errors->any())
                <div class="form-group">
                        @foreach($errors->all() as $error)
                            <p class="alert label-danger">{{$error}}</p>
                        @endforeach
                </div>
            @endif
            <form method="post" action="{{url('/consults/'.$consult->id.'/edit')}}" class="form-horizontal form-disabled" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="col-sm-2 control-label">Paciente</label>
                    <div class="col-sm-10"><input name="other_patient" type="text" class="form-control" value="{{old('other_patient', $consult->other_patient)}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Doctor</label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona una tienda" name="doctor" class="chosen-select"  tabindex="2" required>
                            <option value="">Selecciona un Doctor</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{$doctor->id}}">{{$doctor->name}} {{$doctor->lastName}}</option>
                            @endforeach
                            
                            @foreach ($doctors as $doctor)
                                @php
                                    $selected = "";
                                    if($doctor->id == $consult->doctor->id){
                                        $selected = "selected";
                                    }
                                @endphp
                                <option {{$selected}} value="{{$doctor->id}}">{{$doctor->name}}</option>
                            @endforeach


                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Servicio</label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona un servicio" id="concept" name="concept" class="chosen-select"  tabindex="2" required>
                            <option value="">Selecciona un servicio</option>
                            @foreach ($services as $service)
                                @php
                                    $selected = "";
                                    if($consult->concept){
                                        if($service->id == $consult->concept->id){
                                            $selected = "selected";
                                        }
                                    }
                                    
                                @endphp
                                <option {{$selected}} value="{{$service->id}}" attr-price="{{$service->amount}}">{{$service->name}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                @php
                $disabled = "readonly";
                if($consult->outflow == 1){
                    $disabled = "";
                }
                @endphp
                <div class="form-group">
                    <label class="col-sm-2 control-label">Costo</label>
                    <div class="col-sm-10"><input name="amount" id="amount" type="number" {{$disabled}} class="form-control" value="{{old('amount', $consult->amount)}}"></div>
                </div>

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-9">
                        <a class="btn btn-white" href="{{url('/consults')}}">Cancelar</a>
                        <button class="btn btn-primary" type="submit">Editar</button>
                    </div>
                </div>

            
            </form>

        </div>


        </div><!--END CONTAINER ROW-->
</div><!--END WRAPER-->

<script>
    $("#concept").on('change', function(e){
        var price = $('option:selected', this).attr('attr-price');
        $("#amount").val(price);


    });
</script>

@include('layouts/disablebutton')

@endsection