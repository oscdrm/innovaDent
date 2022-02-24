<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Rahex</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('css/index.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <title>Rahex</title>
</head>
<body>
    <div class="main-container">
        <div class="menu-container">
            <div class="cont-logo" id="logo">
                <figure>
                    <img src="{{asset('/img/back/rahex-logo.png')}}" alt="">
                </figure>
            </div>
            <nav id="menu">
                <div class="cont-navigators">
                    <a href="#1">¿Qué hacemos?</a>
                    <a href="#2">Sucursales</a>
                    <a href="#3">Contacto</a>
                    <span class="indicador" id="indicador"></span>
                </div>
            </nav>
        </div>
        <div class="hero" id="hero">
            <div class="content-hero">
                <div class="txt-hero">
                    <h1>Rahex</h1>
                    <h2>Radiología dental</h2>
                </div>
                <div class="cont-blue-circle">
                    <div class="blue-circle"></div>
                    <div class="img-radiogragia">
                        <figure>
                            <img src="{{asset('/img/back/rahex-back.jpg')}}" alt="">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
        <div class="secciones">
            <div class="seccion que-hacemos" id="1">
                <div class="content-que-hacemos">
                    <div class="cont-circle-darkblue">
                        <div class="darkblue-circle"></div>
                        <div class="img-radiografia-dient">
                            <figure>
                                <img src="{{asset('/img/back/dient.png')}}" alt="">
                            </figure>
                        </div>
                    </div>
                    <div>
                        <h2>¿Qué hacemos?</h2>
                        <br>
                        <p>En rahex Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor minima molestiae asperiores officia totam nostrum voluptates. Minima, eum maiores, in esse ipsa dolores pariatur id dolorem quasi repudiandae cum reiciendis?</p>
                    </div>
                </div>
            </div>
            <div class="seccion sucursales" id="2">
                <h2>Sucursales Rahex</h2>
                <div class="content-sucursales">
                    <div class="contenedor-box-sucursales">
                        <div class="sucursal">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="txt-sucursal">
                                <p class="nombre-sucursal">Huetamo</p>
                                <p class="direccion-sucursal">
                                    Av madero norte #20 Colonia centro, CP 61940
                                    A un costado de tal lugar
                                </p>
                                <div class="cont-redes">
                                    <span class="redes">
                                        <a href=""><i class="fab fa-facebook"></i></a>
                                    </span>
                                    <span class="redes">
                                        <i class="fas fa-phone-alt"></i><a href="tel:5555"> 5522735280</a>
                                    </span>
                                </div>
                                
                            </div>
                        </div>
                        <div class="sucursal">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="txt-sucursal">
                                <p class="nombre-sucursal">Huetamo</p>
                                <p class="direccion-sucursal">
                                    Av madero norte #20 Colonia centro, CP 61940
                                    A un costado de tal lugar
                                </p>
                                <div class="cont-redes">
                                    <span class="redes">
                                        <a href=""><i class="fab fa-facebook"></i></a>
                                    </span>
                                    <span class="redes">
                                        <i class="fas fa-phone-alt"></i><a href="tel:5555"> 5522735280</a>
                                    </span>
                                </div>
                                
                            </div>
                        </div>
                        <div class="sucursal">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="txt-sucursal">
                                <p class="nombre-sucursal">Huetamo</p>
                                <p class="direccion-sucursal">
                                    Av madero norte #20 Colonia centro, CP 61940
                                    A un costado de tal lugar
                                </p>
                                <div class="cont-redes">
                                    <span class="redes">
                                        <a href=""><i class="fab fa-facebook"></i></a>
                                    </span>
                                    <span class="redes">
                                        <i class="fas fa-phone-alt"></i><a href="tel:5555"> 5522735280</a>
                                    </span>
                                </div>
                                
                            </div>
                        </div>
                        <div class="sucursal">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="txt-sucursal">
                                <p class="nombre-sucursal">Huetamo</p>
                                <p class="direccion-sucursal">
                                    Av madero norte #20 Colonia centro, CP 61940
                                    A un costado de tal lugar
                                </p>
                                <div class="cont-redes">
                                    <span class="redes">
                                        <a href=""><i class="fab fa-facebook"></i></a>
                                    </span>
                                    <span class="redes">
                                        <i class="fas fa-phone-alt"></i><a href="tel:5555"> 5522735280</a>
                                    </span>
                                </div>
                                
                            </div>
                        </div>
                        <div class="sucursal">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="txt-sucursal">
                                <p class="nombre-sucursal">Huetamo</p>
                                <p class="direccion-sucursal">
                                    Av madero norte #20 Colonia centro, CP 61940
                                    A un costado de tal lugar
                                </p>
                                <div class="cont-redes">
                                    <span class="redes">
                                        <a href=""><i class="fab fa-facebook"></i></a>
                                    </span>
                                    <span class="redes">
                                        <i class="fas fa-phone-alt"></i><a href="tel:5555"> 5522735280</a>
                                    </span>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="seccion contacto" id="3">
                <div class="content-contacto">
                    <div class="txt-contacto">
                        <h2>Contactanos</h2>
                        <p>Si deseas recibir alguna informacion, dejanos un mensaje y nosotros nos comunicaremos contigo</p>
                    </div>
                    <form action="">
                        <div class="cont-inputs">
                            <div>
                                <label for="name">Nombre</label>
                                <input type="text" name="nombre">
                            </div>
                            <div>
                                <label for="apellido">Apellido</label>
                                <input type="text" name="apellido">
                            </div>
                        </div>
                        <div class="cont-inputs">
                            <div>
                                <label for="phone">Telefono</label>
                                <input type="text" name="telefono">
                            </div>
                            <div>
                                <label for="email">Email</label>
                                <input type="text" name="email">
                            </div>
                        </div>
                        <div class="cont-inputs">
                            <div class="txt-area">
                                <label for="mensaje">Mensaje</label>
                                <textarea name="mensaje" id="" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="cont-inputs btn-sub">
                            <div> 
                                <input class="btn-submit" type="submit" name="submit">
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
            <footer>
                made with ♡ by odrm
            </footer>
        </div>
    </div>
    <script src="{{ asset('js/landing/app.js') }}"></script>
</body>
</html>