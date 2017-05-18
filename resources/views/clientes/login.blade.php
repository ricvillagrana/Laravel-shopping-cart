@extends('layouts.master')

@section('content')
    <div class="page-header">
  <h1>Iniciar sesión</h1>
</div>
@if(count($errors)>0)
  <ul>
    @foreach($errors->all() as $error)
      <li class="alert alert-danger">{{ $error }}</li>
    @endforeach
  </ul>
@endif
<div class="col-md-3"></div>
<form class="col-sm-12 col-md-6" method="post" action="/cliente/login">
  <div class="form-group">
  <label for="email">Correo electrónico</label>
    <input name="correo" pattern="[a-zA-Z.-_][a-zA-Z0-9.-_]*@[a-zA-Z]+.[a-zA-Z]+" type="email" class="form-control" id="email" placeholder="nombre@example.com">
  </div>
  <div class="form-group">
    <label for="password">Contraseña</label>
    <input name="password" type="password" class="form-control" id="password" placeholder="Contraseña">
  </div>
  {!! csrf_field() !!}
  <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Iniciar sesión</button>
  <a class="" href="/cliente/signup"><i class="fa fa-sign-in"></i> Registro</a>
</form>
@endsection