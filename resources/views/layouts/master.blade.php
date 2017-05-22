<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Al Libro Mayor</title>
	@yield('styles')
	<!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/sweetalert2/6.6.2/sweetalert2.min.css">
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('css/magic-check.min.css') }}">

 

	<!-- Font Awesome CDN -->
	<script src="https://use.fontawesome.com/a955b786cf.js"></script>
</head>
<body>
	<nav class="navbar navbar-default navbar">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <i class="fa fa-bars"></i>
        </button>
        <a class="navbar-brand" href="/">Al Libro Mayor</a>
      </div>

      <!-- Collect the nav links, forms, and ot her content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="/">Inicio <span class="sr-only">(current)</span></a></li>
          <!-- <li><a href="/cotizacion">Cotizar</a></li> -->
         <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Productos <span class="caret"></span></a>
            <ul class="dropdown-menu">
            @foreach($data->categorias as $cat)
                <li><a href="/productos/{{ $cat->nombre }}">{{ $cat->nombre }}</a></li>
            @endforeach
              <li role="separator" class="divider"></li>
              <li><a href="/productos">Ver todo</a></li>
            </ul>
          </li>
           <!-- Búsqueda -->

          <div class="navbar-form navbar-left">
            <div class="form-group">
              <input id="query-search" type="text" name="query" class="form-control" placeholder="Buscar">
            </div>
            <a id="search-button" class="btn btn-default">Buscar</a>
          </div>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" style="font-size: 1.5em;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-user-circle"></i> {{ ($data->session != null) ? $data->session->nombre : "Inicia sesión" }}</a>
              <ul class="dropdown-menu">
                @if($data->session != null)
                  <li><a href="/productos/carrito"><i class="fa fa-shopping-cart"></i> Ver carrito <span class="badge"><r id="amount-total" class="money-color">{{ $data->amount }}</r></span></a></li>
                  <li><a id="del-cart"><i class="fa fa-window-close"></i> Vaciar carrito</a></li>
                  <!--<li><a href="#">Hacer pago</a></li>-->
                  <li role="separator" class="divider"></li>
                @endif
                @if($data->session != null)
                  <li><a href="/cliente/profile"><i class="fa fa-user"></i> {{ $data->session->nombre . " " . $data->session->apellido }}</a></li>
                  <!--<li><a href="/cliente/seguimiento"><i class="fa fa-gear fa-spin"></i> Seguimiento</a></li>-->
                  <li><a href="/cliente/signout"><i class="fa fa-sign-out"></i> Cerrar sesión</a></li>
                @else
                  <li><a href="/cliente/signin"><i class="fa fa-sign-in"></i> Iniciar sesión</a></li>
                  <li><a href="/cliente/signup"><i class="fa fa-edit"></i> Registro</a></li>
                @endif
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <div class="container content-all">
    @yield('content')
    </div>
    
    <div class="footer container">
      <div class="col-xs-12 col-sm-6 col-md-6">
        <h1>Acerca de</h1>
          <ul>
            <a class="white" href=""><li>Nustra historia</li></a>
            <a class="white" href=""><li>Politicas de privacidad</li></a>
          </ul>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6">
        <h1>Contáctanos</h1>
          <a><p class="white"><i class="fa fa-facebook-square fa-2x"></i> Facebook</p></a>
          <a><p class="white"><i class="fa fa-whatsapp fa-2x"></i> WhatsApp</p></a>
          <a><p class="white"><i class="fa fa-google-plus-square fa-2x"></i> Google+</p></a>
      </div>
    </div>

    @yield('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/sweetalert2/6.6.2/sweetalert2.min.js" type="text/javascript"></script>
    <script src={{ URL::asset('/js/jquery.matchHeight.js') }} type="text/javascript"></script>
    <script src={{ URL::asset('/js/myApp.js') }} type="text/javascript"></script>
    
  </body>
  </html>