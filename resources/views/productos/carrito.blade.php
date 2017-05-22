@extends('layouts.master')

@section('content')

<div class="panel panel-default clearfix">
	<div class="panel-heading">
		@if(isset($carrito) && $carrito != null)
		<form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post">

			<input type="hidden" name="cmd" value="_cart">
			<input type="hidden" name="upload" value="1">
			<input type="hidden" name="business" value="rikrc.d-facilitator@gmail.com">
			<input type="hidden" name="currency_code" value="MXN">
			@foreach($carrito as $producto)
				<input type="hidden" name="item_name_{{ $loop->iteration }}" value="{{ $producto->nombre }}">
				<input type="hidden" name="amount_{{ $loop->iteration }}" value="{{ $producto->precio }}">
				<input type="hidden" name="quantity_{{ $loop->iteration }}" value="{{ $producto->cantidad }}">
			@endforeach
			<button class="btn btn-primary pull-right" type="submit" value="PayPal"><i class="fa fa-paypal"></i> Pagar con PayPal</button>
		</form>
		@endif

		<h3 class="panel-title">Tu carrito (
			@if($carrito)
				<r id="products-amount">{{ count($carrito) }}</r>
			@else
				<r id="products-amount">{{ 0 }}</r>
			@endif
			artículos )</h3>
			<h1 class="price">TOTAL: {{ $data->amount }}</h1>
		</div> 
		<div style="display: block;" id="si-carrito" class="panel-body">
			@if($carrito)
			@foreach($carrito as $producto)
			<div class="col-xs-6 col-md-3 col-sm-4">
		        <div class="thumbnail" data-mh="my-group">
		        <div class="img-container">
			        <a href="/productos/ver/{{ $producto->id }}">
			        	<img class="image-product" src={{ $producto->image_url }} resposive>
			        </a>
			    </div>
		          <div class="caption clearfix">
		            <h4>{{ Html::link('/productos/ver/'.$producto->id, $producto->nombre) }}</h4>
		            <p >
		            	Precio unitario: {{ $producto->precioF }}<br>
		            	Cantidad: {{ $producto->cantidad }}<br>
		            	Total: <b class="price">{{ $producto->total }}</b>
		            </p>
		            <a href="/productos/ver/{{ $producto->id }}" class="btn btn-default pull-right btn-block btn-xlarge" role="button"> <i class="fa fa-info-circle"></i> Detalles</a>
		            <a id={{ $producto->id }} class="btn btn-warning pull-right edit-product btn-block btn-xlarge" role="button"> <i class="fa fa-edit"></i> Editar</a>
		            </div>
		          </div>
		        </div>
			@endforeach
		@else
			<center><h1>No hay artículos en tu carrito.</h1><a class="btn btn-primary" href="/"><i class="fa fa-shopping-bag"></i> Ver más artículos</a></center>
		@endif
	</div>
	<div style="display: none;" id="no-carrito" class="panel-body">
		<center><h1>No hay artículos en tu carrito.</h1><a class="btn btn-primary" href="/"><i class="fa fa-shopping-bag"></i> Ver más artículos</a></center>
	</div>

	<div class="delete-hide">
		<div class="blank"></div>
		<center>
			<div class="box">
				<h1>Editar producto.</h1>
				<p>ID del producto: <r id="product-id"></r></p>
				<p>Puedes editar la cnatidad o eliminar el producto.</p>
				<label for="cantidad">Cantidad:</label>
		          <select id="cantidad-product" class="form-control" name="cantidad">
			          @for($i = 1; $i <= 50; $i++)
			            <option id="cantidad-product-{{ $i }}" value="{{ $i }}">{{ $i }}</option>
			          @endfor
		          </select>
		          <br>
		          <a class="product-edited btn btn-success"><i class="fa fa-check"></i> Editar</a>
		          <a class="product-deleted btn btn-danger"><i class="fa fa-remove"></i> Eliminar</a>
			</div>
		</center>
	</div>
</div>
@endsection