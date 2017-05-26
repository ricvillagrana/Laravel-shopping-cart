@extends('layouts.master')

@section('content')

<div class="panel panel-default">
  <div class="panel-heading">
    <h2>{{ $producto->nombre }}</h2>
  </div>
  <div class="panel-body">
    <div class="col-xs-12 col-sm-4">
      <img class="image-product" src={{ $producto->image_url }}>
    </div>

    <div class="col-xs-12 col-sm-8">
      <h3 class="price">{{ $producto->getPrecio() }}</h3>
      <p>{{ $producto->descripcion }}</p>
      <div class="row">
        <div class="col-xs-3 col-sm-3 col-md-2">
          <label for="cantidad">Cantidad:</label>
          <input class="form-control" id="cantidad-product" type="number" name="quantity" min={{ $producto->cant_min+1 }} max={{ $producto->cant_max }} value="1">
        </div>
      </div>
      <div class="row">
        <a id={{ $producto->id }} class="btn btn-success pull-right add-cart" role="button"> <i class="fa fa-cart-plus"></i> Añadir al carrito</a>
      </div>
    </div>
  </div>

  <div class="panel-footer">
  </div>
</div>


@endsection