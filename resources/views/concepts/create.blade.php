@extends('layouts.app2')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>Rahex</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('/concepto')}}">Concepto</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Crear nuevo concepto</strong>
                </li>
            </ol>
        </div>
    </div>

<div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">

            <div class="ibox-content shad col-12">
                <h4>Crear nueva concepto</h4>
                <div class="hr-line-dashed"></div>
                @if($errors->any())
                    <div class="form-group">
                            @foreach($errors->all() as $error)
                                <p class="alert label-danger">{{$error}}</p>
                            @endforeach
                    </div>
                @endif
                <div class="ibox-content">
                    <form method="post" action="{{url('/concepts')}}" id="form" class="form-horizontal">
                        @csrf
                
                         <div class="form-group">
                            <label class="col-sm-2 control-label">Nombre</label>
                            <div class="col-sm-10"><input name="name" type="text" class="form-control" value="{{old('name')}}"></div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Costo</label>
                            <div class="col-sm-10"><input name="amount" type="number" class="form-control" value="{{old('amount')}}"></div>
                        </div>

                        <div class="form-group">
                                <label class="col-sm-2 control-label">Tienda</label>
                                <div class="col-sm-10">
                                    <select data-placeholder="Selecciona una tienda" name="surgeries[]" id="tiendas" class="chosen-select" multiple  tabindex="2">
                                        <option value="">Selecciona una tienda</option>
                                        @foreach ($stores as $store)
                                            <option value="{{$store->id}}">{{$store->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>


                        <br>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-9">
                                <a class="btn btn-white" href="{{url('/concepts')}}">Cancelar</a>
                                <button class="btn btn-primary" id="save" type="submit">Guardar</button>
                            </div>
                        </div>
                        

                    </form>
                </div>

            </div>


        </div><!--END CONTAINER ROW-->

        
</div><!--END WRAPER-->
@endsection
