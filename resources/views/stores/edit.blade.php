@extends('layouts.app2')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Tiendas</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{url('/home')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{url('/stores')}}">Tiendas</a>
                        </li>
                        <li class="active">
                            <strong>Editar Tienda</strong>
                        </li>
                    </ol>
                </div>
</div><!-- END SECCION TITULO-->

<div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">

        <div class="ibox-content">
            <h4>Editar tienda</h4>
            <div class="hr-line-dashed"></div>
            @if($errors->any())
                <div class="form-group">
                        @foreach($errors->all() as $error)
                            <p class="alert label-danger">{{$error}}</p>
                        @endforeach
                </div>
            @endif
            <form method="post" action="{{url('/stores/'.$store->id.'/edit')}}" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nombre</label>
                    <div class="col-sm-10"><input name="name" type="text" class="form-control" value="{{old('name', $store->name)}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Dirección</label>
                    <div class="col-sm-10"><input name="address" type="text" class="form-control" value="{{old('address', $store->address)}}"></div>
                </div>

               

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-9">
                        <a class="btn btn-white" href="{{url('/stores')}}">Cancelar</a>
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                </div>

            
            </form>

        </div>


        </div><!--END CONTAINER ROW-->
</div><!--END WRAPER-->

@endsection