@extends('layouts.master')
@section("h1", "Socios")
@section('content')
@include('notification')
<div class="card card-default">
  <div class="card-header">
    <h3 class="card-title">Ver Socio</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="remove">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
  <form method="" action="">


  <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
  <div class="card-body">
    <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label>Tipo Documento</label>
            <select class="form-control select2" name="tipo_doc" style="width: 100%;" required readonly>
              <option selected="selected" value="DNI">DNI</option>
              <option value="CUIT">CUIT</option>
              <option value="CUIL">CUIL</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Número Documento</label>
            <input type="text" class="form-control" name="nro_doc" value="{{$socio->nro_doc}}" required readonly>
          </div>
        </div>

      </div>
      <!-- /.col -->
      <div class="row">
        <div class="form-group col-md-6">
          <label>Nombres</label>
          <input type="text" class="form-control" name="nombre" value="{{$socio->nombre}}" required readonly>

        </div>
        <!-- /.form-group -->
        <div class="form-group col-md-6">
          <label>Apellido</label>
          <input type="text" class="form-control" name="apellido" value="{{$socio->apellido}}" required readonly>
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
          <input type="text" class="form-control" name="calle" value="{{$socio->calle}}" required readonly>
        </div>
        <!-- /.form-group -->
      </div>
      <div class="col-3 col-xs-6">
        <div class="form-group">
          <label>Número</label>
          <input type="text" class="form-control" name="numero" value="{{$socio->numero}}" required readonly>
        </div>
        <!-- /.form-group -->
      </div>
      <div class="col-2 col-xs-6">
        <div class="form-group">
          <label>Piso</label>
          <input type="text" class="form-control" name="piso" value="{{$socio->piso}}" required readonly>
        </div>
        <!-- /.form-group -->
      </div>
      <div class="col-2 col-xs-6">
        <div class="form-group">
          <label>Dpto</label>
          <input type="text" class="form-control" name="dpto" value="{{$socio->dpto}}" required readonly>
        </div>
        <!-- /.form-group -->
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Código Postal</label>
          <input type="text" class="form-control" name="codigo_postal" value="{{$socio->codigo_postal}}" required readonly>
        </div>
        <!-- /.form-group -->
      </div>
      <div class="col-md-3 offset-md-3">
        <div class="form-group">
          <label>Código Area</label>
          <input type="text" class="form-control" name="codigo_area" value="{{$socio->codigo_area}}" required readonly>
        </div>
        <!-- /.form-group -->
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Telefono</label>
          <input type="text" class="form-control" name="telefono" value="{{$socio->telefono}}" required readonly>
        </div>
        <!-- /.form-group -->
      </div>
      <div class="col-md-8">
        <div class="form-group">
          <label>Mail</label>
          <input type="text" class="form-control" name="mail" value="{{$socio->mail}}" required readonly>
        </div>
        <!-- /.form-group -->
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Fecha Ingreso</label>
          <input type="date" class="form-control" name="fecha_ingreso" value="{{$socio->fecha_ingreso}}" required readonly>
        </div>
        <!-- /.form-group -->
      </div>


    </div>

    <!-- /.row -->
  </div>
</form>
</div>
<div class="card card-default">
  <div class="card-header">
    <h3 class="card-title">Cuotas Pagas</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="remove">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>

<div class="card-body">
  <table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th>Fecha de pago</th>
      <th>Periodo</th>
      <th>Estado</th>
      <th>Importe</th>
      <th>Accion</th>
    </tr>
    </thead>
    <tbody>
      @foreach($cuotas as $cuota)
      <?php
      $datetime1 = new DateTime();
      $datetime2 = new DateTime($cuota->fecha_hasta);
      $interval = $datetime1->diff($datetime2);
      $dias_restantes = $interval->format('%R%a');

       ?>
       @if($dias_restantes < 5 && $dias_restantes >= 0) <!-- proximo a vencerce  -->
       <tr class="tr-por-vencer">
         <td>{{date("d/m/Y", strtotime($cuota->fecha_pago))}}</td>
         <td>{{date("d/m/Y", strtotime($cuota->fecha_desde))}} - {{date("d/m/Y", strtotime($cuota->fecha_hasta))}}</td>
         <td>Por vencer</td>
         <td class="text-right text-monospace">${{ number_format($cuota->importe, 2, ',', '.') }}</td>
         <td>
           <a class="btn btn-app btn-eliminar" data-toggle="modal" data-idcuota="{{$cuota->id}}">
             <i class="fas fa-trash"></i> eliminar
           </a>
         </td>
       </tr>
       @else
         @if($dias_restantes < 0) <!-- cuota vencida  -->
         <tr class="tr-vencida">
           <td>{{date("d/m/Y", strtotime($cuota->fecha_pago))}}</td>
           <td>{{date("d/m/Y", strtotime($cuota->fecha_desde))}} - {{date("d/m/Y", strtotime($cuota->fecha_hasta))}}</td>
           <td>Vencida</td>
           <td class="text-right text-monospace">${{ number_format($cuota->importe, 2, ',', '.') }}</td>
           <td>
             <a class="btn btn-app btn-eliminar" data-toggle="modal" data-idcuota="{{$cuota->id}}">
               <i class="fas fa-trash"></i> eliminar
             </a>
           </td>
         </tr>
         @else
         <tr>

           <td>{{date("d/m/Y", strtotime($cuota->fecha_pago))}}</td>
           <td>{{date("d/m/Y", strtotime($cuota->fecha_desde))}} - {{date("d/m/Y", strtotime($cuota->fecha_hasta))}}</td>
           <td>Habilitado</td>
           <td class="text-right text-monospace">${{ number_format($cuota->importe, 2, ',', '.') }}</td>
           <td>
             <a class="btn btn-app btn-eliminar" data-toggle="modal" data-idcuota="{{$cuota->id}}">
               <i class="fas fa-trash"></i> eliminar
             </a>
           </td>
         </tr>
         @endif
       @endif

      @endforeach
    </tbody>
  </table>
</div>
</div>
@include('socios.modals.confirm-delete-cuota')
<script type="text/javascript">
$( document ).ready(function() {
  $( ".btn-eliminar" ).click(function() {
    console.log($(this).data("idcuota"));
    $('#form-eliminar-cuota').attr('action', '/cuotas/'+$(this).data("idcuota"))
  $('#modal-delete').modal('show');
  });
});
</script>
@endsection
