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
                            <strong>Nueva Consulta</strong>
                        </li>
                    </ol>
                </div>
</div><!-- END SECCION TITULO-->

<div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">

        <div class="ibox-content shad">
            <h4>Registrar nueva consulta</h4>
            <div class="hr-line-dashed"></div>
            @if($errors->any())
                <div class="form-group">
                        @foreach($errors->all() as $error)
                            <p class="alert label-danger">{{$error}}</p>
                        @endforeach
                </div>
            @endif
            <form method="post" action="{{url('/consults')}}" class="form-horizontal form-disabled" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="col-sm-2 control-label">Paciente</label>
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
                        <select data-placeholder="Selecciona una tienda" id="concept" name="concept" class="chosen-select"  tabindex="2" required>
                            <option value="">Selecciona un servicio</option>
                            @foreach ($services as $service)
                                <option value="{{$service->id}}" attr-price="{{$service->amount}}">{{$service->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @if(auth()->user()->role->id == 1)
                <div class="form-group">
                    <label class="col-sm-2 control-label">Tienda</label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona una tienda" name="surgery" class="chosen-select"  tabindex="2" required>
                            <option value="">Selecciona una tienda</option>
                            @foreach ($surgeries as $surgery)
                                <option value="{{$surgery->id}}">{{$surgery->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif

                <div class="form-group">
                    <label class="col-sm-2 control-label">Costo</label>
                    <div class="col-sm-10"><input name="amount" id="amount" type="number" class="form-control" disabled value="{{old('amount')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Tipo de Pago</label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona una tipo de pago" name="payment_method" class="chosen-select"  tabindex="2" required>
                            @foreach ($payments as $payment)
                                <option value="{{$payment->id}}">{{$payment->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

               
                    <div class="form-group" id="dc">
                                    <label class="font-normal">Selecciona la fecha de consulta:</label>
                                    <div class="input-group date dc-date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="date-consult" name="date-consult" type="text" data-date-format="dd/mm/yyyy" class="form-control dci">
                                    </div>
                    </div>
               


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


<script>
    $("#concept").on('change', function(e){
        var price = $('option:selected', this).attr('attr-price');
        $("#amount").val(price);


    });
</script>

@include('layouts/disablebutton')

@endsection