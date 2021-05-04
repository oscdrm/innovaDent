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
                            <a href="{{url('/consults')}}">Registrar movimiento</a>
                        </li>
                        <li class="active">
                            <strong>Nuevo Movimiento</strong>
                        </li>
                    </ol>
                </div>
</div><!-- END SECCION TITULO-->

<div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">

        <div class="ibox-content shad">
            <h4>Registrar nuevo movimiento</h4>
            <div class="hr-line-dashed"></div>
            @if($errors->any())
                <div class="form-group">
                        @foreach($errors->all() as $error)
                            <p class="alert label-danger">{{$error}}</p>
                        @endforeach
                </div>
            @endif
            <form method="post" action="{{url('/movements/store')}}" class="form-horizontal form-disabled" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="col-sm-2 control-label">Concepto</label>
                    <div class="col-sm-10"><input name="other_concept" required type="text" class="form-control" value="{{old('other_concept')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Monto</label>
                    <div class="col-sm-10"><input name="amount" required type="number" class="form-control" value="{{old('amount')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Egreso/Ingreso</label>
                    <input type="checkbox" class="js-switch_2" checked name="dismount"/>
                </div>

                @if(auth()->user()->role->id == 1)

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tienda:</label>
                        <div class="col-sm-10">
                            <select data-placeholder="Selecciona una tienda" name="surgery" class="chosen-select"  tabindex="2" required>
                                <option value="">Selecciona una tienda</option>
                                @foreach ($surgeries as $surgery)
                                    <option value="{{$surgery->id}}">{{$surgery->name}}</option>
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


@include('layouts/disablebutton')
@section('switchery')

    var elem_2 = document.querySelector('.js-switch_2');
    var switchery_2 = new Switchery(elem_2, { color: '#ED5565' });

@endsection