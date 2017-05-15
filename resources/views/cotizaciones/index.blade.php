@extends('layouts.master')

@section('content')
<div class="page-header">
  <h1>Orden de trabajo</h1>
</div>

<div class="col-xs-12 col-sm-3 col-md-3"></div>
<div class="col-xs-12 col-sm-6 col-md-6">
  {!! Form::open() !!}
    <input type="hidden" name="id_cliente" value="0">

    <div class="form-group">
      <h3 for="tipo_servicio">Tipo de servicio</h3>
      <input class="magic-radio" type="radio" name="tipo_servicio" id="tipo_servicio_Normal" checked><label for="tipo_servicio_Normal">Normal</label>
      <input class="magic-radio" type="radio" name="tipo_servicio" id="tipo_servicio_Urgente"><label for="tipo_servicio_Urgente">Urgente</label>
      <input class="magic-radio" type="radio" name="tipo_servicio" id="tipo_servicio_Extra"><label for="tipo_servicio_Extra">Extra</label>
    </div>



    <div class="form-group">
      <h3 for="tipo_servicio">Empastado</h3>
      <input class="magic-radio" type="radio" name="empastado" id="empastado_Tesis" checked><label for="empastado_Tesis">Tesis</label>
      <input class="magic-radio" type="radio" name="empastado" id="empastado_Libro"><label for="empastado_Libro">Libro</label>
    </div>


    <div class="form-group">
      <h3 for="tipo_servicio">Tipo de pasta</h3>
      <input class="magic-radio" type="radio" name="tipo_pasta" id="tipo_pasta_dura" checked><label for="tipo_pasta_dura">Pasta dura</label>
      <input class="magic-radio" type="radio" name="tipo_pasta" id="tipo_pasta_delgada"><label for="tipo_pasta_delgada">Pasta delgada</label>
      <input class="magic-radio" type="radio" name="tipo_pasta" id="tipo_pasta_calidad"><label for="tipo_pasta_calidad">Pasta de calidad otográica</label>
    </div>
  {!! Form::close() !!}
</div>
@endsection