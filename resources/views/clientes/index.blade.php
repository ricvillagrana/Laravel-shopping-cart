@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
	  <div class="panel-body centered">
	  	<i style="font-size: 12em;" class="fa fa-user-circle fa-4x"></i><br>
	    <h3>
	    	{{ $data->session->nombre." ".$data->session->apellido }}
	    </h3>
	    <h4>
	    	Correo electrónico: {{ $data->session->correo }}
	    </h4>
	   	<h4>
	    	Teléfono: {{ $data->session->telefono }}
	    </h4>
	  </div>
	  <div class="panel-footer"><a href="#" class="btn btn-warning"><i class="fa fa-edit"></i> Editar</a></div>
	</div>
@endsection