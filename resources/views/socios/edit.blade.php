@extends('layouts.master')
@section("h1", "Socios")
@section('content')

<div class="card card-default">
  <div class="card-header">
    <h3 class="card-title">Editar Socio</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="remove">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
  <form method="POST" action="{{route("socios.update", [$socio])}}">
    @method("PUT")

  <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
  <div class="card-body">
    <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label>Tipo Documento</label>
            <select class="form-control select2" name="tipo_doc" style="width: 100%;" required>
              <option selected="selected" value="DNI">DNI</option>
              <option value="CUIT">CUIT</option>
              <option value="CUIL">CUIL</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Número Documento</label>
            <input type="number" class="form-control" name="nro_doc" value="{{$socio->nro_doc}}" required>
          </div>
        </div>

      </div>
      <!-- /.col -->
      <div class="row">
        <div class="form-group col-md-6">
          <label>Nombres</label>
          <input type="text" class="form-control" name="nombre" value="{{$socio->nombre}}" required>

        </div>
        <!-- /.form-group -->
        <div class="form-group col-md-6">
          <label>Apellido</label>
          <input type="text" class="form-control" name="apellido" value="{{$socio->apellido}}" required>
        </div>
        <!-- /.form-group -->
      </div>
      <!-- /.col -->

    <!-- /.row -->

    <h5>Datos Personales</h5>
    <div class="row">
      <div class="col-5 col-xs-6">
        <div class="form-group">
          <label>Dirección</label>
          <input type="text" class="form-control" name="calle" value="{{$socio->calle}}" required>
        </div>
        <!-- /.form-group -->
      </div>
      <div class="col-3 col-xs-6">
        <div class="form-group">
          <label>Número</label>
          <input type="number" class="form-control" name="numero" value="{{$socio->numero}}" required>
        </div>
        <!-- /.form-group -->
      </div>
      <div class="col-2 col-xs-6">
        <div class="form-group">
          <label>Piso</label>
          <input type="text" class="form-control" name="piso" value="{{$socio->piso}}" >
        </div>
        <!-- /.form-group -->
      </div>
      <div class="col-2 col-xs-6">
        <div class="form-group">
          <label>Dpto</label>
          <input type="text" class="form-control" name="dpto" value="{{$socio->dpto}}" >
        </div>
        <!-- /.form-group -->
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Código Postal</label>
          <input type="number" class="form-control" name="codigo_postal" value="{{$socio->codigo_postal}}" required>
        </div>
        <!-- /.form-group -->
      </div>
      <div class="col-md-3 offset-md-3">
        <div class="form-group">
          <label>Código Area</label>
          <input type="number" class="form-control" name="codigo_area" value="{{$socio->codigo_area}}" required>
        </div>
        <!-- /.form-group -->
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Telefono</label>
          <input type="number" class="form-control" name="telefono" value="{{$socio->telefono}}" required>
        </div>
        <!-- /.form-group -->
      </div>
      <div class="col-md-8">
        <div class="form-group">
          <label>Mail</label>
          <input type="text" class="form-control" name="mail" value="{{$socio->mail}}" required>
        </div>
        <!-- /.form-group -->
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Fecha Ingreso</label>
          <input type="date" class="form-control" name="fecha_ingreso" value="{{$socio->fecha_ingreso}}" required>
        </div>
        <!-- /.form-group -->
      </div>


    </div>
    <button class="btn btn-primary" type="submit">Modificar</button>
    <!-- /.row -->
  </div>
</form>
</div>



@endsection
