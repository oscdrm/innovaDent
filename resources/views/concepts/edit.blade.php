@extends('layouts.app2')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading shad">
                <div class="col-lg-9">
                    <h2>Servicios</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{url('/home')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{url('/concepts')}}">Servicios</a>
                        </li>
                        <li class="active">
                            <strong>Editar Servicio</strong>
                        </li>
                    </ol>
                </div>
</div><!-- END SECCION TITULO-->

<div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">

        <div class="ibox-content shad">
            <h4>Editar servicio</h4>
            <div class="hr-line-dashed"></div>
            @if($errors->any())
                <div class="form-group">
                        @foreach($errors->all() as $error)
                            <p class="alert label-danger">{{$error}}</p>
                        @endforeach
                </div>
            @endif
            <form method="post" action="{{url('/concepts/'.$concept->id.'/edit')}}" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nombre</label>
                    <div class="col-sm-10"><input name="name" type="text" class="form-control" value="{{old('name', $concept->name)}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Tienda</label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona una tienda" name="surgery" class="chosen-select"  tabindex="2" required>
                            <option value="">Selecciona una tienda</option>
                            @foreach ($stores as $store)
                                @php
                                    $selected = "";
                                    if($store->id == $concept->surgery->id){
                                        $selected = "selected";
                                    }
                                @endphp
                                <option {{$selected}} value="{{$store->id}}">{{$store->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

               

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-9">
                        <a class="btn btn-white" href="{{url('/concepts')}}">Cancelar</a>
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                </div>

            
            </form>

        </div>


        </div><!--END CONTAINER ROW-->
</div><!--END WRAPER-->

@endsection