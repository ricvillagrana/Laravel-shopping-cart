@extends('layouts.master')

@section('content')
    <div class="page-header">
      <h1>{{ $cat }}</h1>
    </div>
    @foreach($productos as $producto)
      <div class="col-xs-6 col-md-3 col-sm-4">
        <div class="thumbnail" data-mh="my-group">
          <div class="img-container">
            <a href="/productos/ver/{{ $producto->id }}">
              <img class="image-product" src={{ $producto->image_url }} resposive>
            </a>
          </div>
          <div class="caption clearfix">
            <h4>{{ Html::link('/productos/ver/'.$producto->id, $producto->nombre_p) }}</h4>
            <a href="/productos/{{ $producto->nombre }}"><span class="badge">{{ $producto->nombre }}</span></a>
            <p class="price">{{ $producto->getPrecio() }}</p>
            <div class="buttons pull-bottom">
              <a href="/productos/ver/{{ $producto->id }}" class="btn btn-primary pull-right btn-block btn-xlarge" role="button"> <i class="fa fa-info-circle"></i> Detalles</a>
              
            </div>
          </div>
        </div>
      </div>
    @endforeach
  @endsection