@extends('layouts.app')

@section('content')
<div class="middle-box text-center loginscreen animated bounceInDown">
        <div>
            <div>

                <h1 class="logo-name">IDH</h1>

            </div>
            <h3>Bienvenido a INNOVA DENT</h3>
            <p>Por favor inicia sesión para entrar en acción</p>
            <form class="m-t" role="form"  method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input id="email" type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email"
                           value="{{old ('email')}}" 
                           placeholder="Usuario"
                           required autocomplete="email" autofocus
                    >
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input id="password" type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password" 
                           placeholder="Contraseña"
                           required autocomplete="current-password"
                    >
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        <small>{{ __('¿Olvidaste tu contraseña?') }}</small>
                    </a>
                @endif
            </form>
            <!--<p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>-->
        </div>
    </div>
@endsection
