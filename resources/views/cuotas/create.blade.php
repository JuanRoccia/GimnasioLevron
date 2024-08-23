
@extends('layouts.master')
@section("h1", "Cuotas")
@section('content')

<div class="card card-default">
  <div class="card-header">
    <h3 class="card-title">Nueva Cuota</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="remove">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
  <form method="POST" action="{{action('CuotaController@store')}}">
  <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
    <input type="hidden" name="socio_id" value="{{$socio->id}}">
  <div class="card-body">
    <div class="row">


        <div class="col-md-4">
          <div class="form-group">
            <label>Número Documento</label>
            <input type="text" class="form-control" name="nro_doc" value="{{$socio->nro_doc}}" required readonly>
          </div>
        </div>
        <div class="form-group col-md-4">
          <label>Nombres</label>
          <input type="text" class="form-control" name="nombre" value="{{$socio->nombre}}" required readonly>

        </div>
        <div class="form-group col-md-4">
          <label>Apellido</label>
          <input type="text" class="form-control" name="apellido" value="{{$socio->apellido}}" required readonly>
        </div>

      </div>

    <h5>Ingresar nueva cuota</h5>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Fecha de pago</label>
          <input type="date" class="form-control" name="fecha_pago" value="" required >
        </div>
        <!-- /.form-group -->
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Importe</label>
          <input type="number" class="form-control" name="importe" value="" required >
        </div>
        <!-- /.form-group -->
      </div>
    </div>
    <h5>Periodo</h5>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Desde</label>
          <input type="date" class="form-control" name="fecha_desde" value="" required>
        </div>
        <!-- /.form-group -->
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>hasta</label>
          <input type="date" class="form-control" name="fecha_hasta" value="" required >
        </div>
    </div>
    <button class="btn btn-primary" type="submit">Crear</button>
    <!-- /.row -->
  </div>
</form>
</div>

@endsection
