@extends('layouts.master')

@section('content')
<div class="page-header">
  <h1>Registro de cliente</h1>
</div>
@if(count($errors)>0)
  <ul>
    @foreach($errors->all() as $error)
      <li class="alert alert-danger">{{ $error }}</li>
    @endforeach
  </ul>
@endif
<div class="col-md-3"></div>
<form class="col-sm-12 col-md-6" method="post" action="/cliente/create">
  <div class="form-group">
  <label for="email">Correo electrónico</label>
    <input name="correo" pattern="[a-zA-Z.-_][a-zA-Z0-9.-_]*@[a-zA-Z]+.[a-zA-Z]+" type="email" class="form-control" id="email" placeholder="nombre@example.com">
  </div>
  <div class="form-group">
  <label for="nombre">Nombre</label>
    <input name="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre">
  </div>
  <div class="form-group">
  <label for="apellido">Apellido</label>
    <input name="apellido" type="text" class="form-control" id="apellido" placeholder="Apellido">
  </div>
  <div class="form-group">
  <label for="telefono">Número telefónico</label>
    <input name="telefono" pattern="[0-9]+" type="number" class="form-control" id="telefono" placeholder="3125555555">
  </div>
  <div class="form-group">
    <label for="password">Contraseña</label>
    <input name="password" type="password" class="form-control" id="password" placeholder="Contraseña">
  </div>
  <div class="form-group">
    <label for="password_confirmation">Confirmación de contraseña</label>
    <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Confirmación de contraseña">
  </div>
  {!! csrf_field() !!}
  <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Regsitrarme</button>
  <a class="" href="/cliente/signin"><i class="fa fa-sign-in"></i> Iniciar sessión</a>
</form>
@endsection