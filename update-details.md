<!-- resources/views/socios/index.blade.php -->

@extends('layouts.master')
@section("h1", "Socios")

@section('content')
@include('notification')

  <div class="row">
    <div class="col-md-12">
      <a href="/socios/create" class="btn btn-success">Nuevo Socio</a>
    </div>
  </div>


  <div class="card-body">
    <table id="example1" class="table table-bordered ">
      <thead>
      <tr>
        <th>ID</th>
        <th>Nombre y apellido</th>
        <th>DNI</th>
        <th>fecha de ingreso</th>
        <th>Accion</th>
      </tr>
      </thead>
      <tbody>
        @foreach($socios as $socio)
        <tr>
          <td>{{$socio->id}}</td>
          <td>{{$socio->nombre}} {{$socio->apellido}}</td>
          <td>{{$socio->nro_doc}}</td>
          <td>{{$socio->fecha_ingreso}}</td>
          <td>

            <a class="btn btn-app btn-cuota" href="cuotas/create?socio_id={{$socio->id}}">
              <i class="fas fa-money-check-alt"></i> Cuota
            </a>

            <a class="btn btn-app btn-ver" href="{{route("socios.show",[$socio])}}">
              <i class="fas fa-eye"></i> Ver
            </a>
            <a class="btn btn-app btn-editar" href="{{route("socios.edit",[$socio])}}">
              <i class="fas fa-edit"></i> Editar
            </a>
            <a class="btn btn-app btn-eliminar" data-toggle="modal" data-idsocio="{{$socio->id}}" data-nombresocio="{{$socio->nombre}} {{$socio->apellido}}">
              <i class="fas fa-trash"></i> eliminar
            </a>
        </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@include('socios.modals.confirm-delete')
  <script type="text/javascript">
  $( document ).ready(function() {
      $("#example1").DataTable({
        responsive: true,
        language:{
    "processing": "Procesando...",
    "lengthMenu": "Mostrar _MENU_ registros",
    "zeroRecords": "No se encontraron resultados",
    "emptyTable": "Ningún dato disponible en esta tabla",
    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
    "search": "Buscar:",
    "infoThousands": ",",
    "loadingRecords": "Cargando...",
    "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
    },
    "aria": {
        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad",
        "collection": "Colección",
        "colvisRestore": "Restaurar visibilidad",
        "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
        "copySuccess": {
            "1": "Copiada 1 fila al portapapeles",
            "_": "Copiadas %d fila al portapapeles"
        },
        "copyTitle": "Copiar al portapapeles",
        "csv": "CSV",
        "excel": "Excel",
        "pageLength": {
            "-1": "Mostrar todas las filas",
            "1": "Mostrar 1 fila",
            "_": "Mostrar %d filas"
        },
        "pdf": "PDF",
        "print": "Imprimir"
    },
    "autoFill": {
        "cancel": "Cancelar",
        "fill": "Rellene todas las celdas con <i>%d<\/i>",
        "fillHorizontal": "Rellenar celdas horizontalmente",
        "fillVertical": "Rellenar celdas verticalmentemente"
    },
    "decimal": ",",
    "searchBuilder": {
        "add": "Añadir condición",
        "button": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
        },
        "clearAll": "Borrar todo",
        "condition": "Condición",
        "conditions": {
            "date": {
                "after": "Despues",
                "before": "Antes",
                "between": "Entre",
                "empty": "Vacío",
                "equals": "Igual a",
                "notBetween": "No entre",
                "notEmpty": "No Vacio",
                "not": "Diferente de"
            },
            "number": {
                "between": "Entre",
                "empty": "Vacio",
                "equals": "Igual a",
                "gt": "Mayor a",
                "gte": "Mayor o igual a",
                "lt": "Menor que",
                "lte": "Menor o igual que",
                "notBetween": "No entre",
                "notEmpty": "No vacío",
                "not": "Diferente de"
            },
            "string": {
                "contains": "Contiene",
                "empty": "Vacío",
                "endsWith": "Termina en",
                "equals": "Igual a",
                "notEmpty": "No Vacio",
                "startsWith": "Empieza con",
                "not": "Diferente de"
            },
            "array": {
                "not": "Diferente de",
                "equals": "Igual",
                "empty": "Vacío",
                "contains": "Contiene",
                "notEmpty": "No Vacío",
                "without": "Sin"
            }
        },
        "data": "Data",
        "deleteTitle": "Eliminar regla de filtrado",
        "leftTitle": "Criterios anulados",
        "logicAnd": "Y",
        "logicOr": "O",
        "rightTitle": "Criterios de sangría",
        "title": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
        },
        "value": "Valor"
    },
    "searchPanes": {
        "clearMessage": "Borrar todo",
        "collapse": {
            "0": "Paneles de búsqueda",
            "_": "Paneles de búsqueda (%d)"
        },
        "count": "{total}",
        "countFiltered": "{shown} ({total})",
        "emptyPanes": "Sin paneles de búsqueda",
        "loadMessage": "Cargando paneles de búsqueda",
        "title": "Filtros Activos - %d"
    },
    "select": {
        "1": "%d fila seleccionada",
        "_": "%d filas seleccionadas",
        "cells": {
            "1": "1 celda seleccionada",
            "_": "$d celdas seleccionadas"
        },
        "columns": {
            "1": "1 columna seleccionada",
            "_": "%d columnas seleccionadas"
        }
    },
    "thousands": ".",
    "datetime": {
        "previous": "Anterior",
        "next": "Proximo",
        "hours": "Horas",
        "minutes": "Minutos",
        "seconds": "Segundos",
        "unknown": "-",
        "amPm": [
            "am",
            "pm"
        ]
    },
    "editor": {
        "close": "Cerrar",
        "create": {
            "button": "Nuevo",
            "title": "Crear Nuevo Registro",
            "submit": "Crear"
        },
        "edit": {
            "button": "Editar",
            "title": "Editar Registro",
            "submit": "Actualizar"
        },
        "remove": {
            "button": "Eliminar",
            "title": "Eliminar Registro",
            "submit": "Eliminar",
            "confirm": {
                "_": "¿Está seguro que desea eliminar %d filas?",
                "1": "¿Está seguro que desea eliminar 1 fila?"
            }
        },
        "error": {
            "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
        },
        "multi": {
            "title": "Múltiples Valores",
            "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
            "restore": "Deshacer Cambios",
            "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
        }
    },
    "info": "Mostrando de _START_ a _END_ de _TOTAL_ entradas"
}
      });



  $( ".btn-eliminar" ).click(function() {
    $('#nombre-socio').html($(this).data("nombresocio"));
    $('#form-eliminar-socio').attr('action', 'socios/'+$(this).data("idsocio"))
  $('#modal-delete').modal('show');
});
});

  </script>
@endsection

<!-- app/Http/Controllers/SocioController.php -->

<?php

namespace App\Http\Controllers;

use App\Socio;
use App\Cuota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SocioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socios = Socio::all();
        return view('socios.index',compact('socios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('socios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      DB::beginTransaction();
      try {
        //return $request->all();
        $socio = new Socio($request->except('cuota'));
        $socio->saveOrFail();

        $cuota = new Cuota($request->input('cuota'));
        $cuota->socio_id = $socio->id;
        $cuota->activa = 1;
        $cuota->notificado = 0;
        $cuota->saveOrFail();

        DB::commit();

        return redirect()->route("socios.index")->with([
          "mensaje" => "¡Socio y cuota agregados con éxito!",
          "tipo" => "success"
        ]);
      } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with([
          "mensaje" => "¡Error al agregar socio y cuota!" . $e->getMessage(),
          "tipo" => "danger"
        ])->withInput();
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Socio  $socio
     * @return \Illuminate\Http\Response
     */
    public function show(Socio $socio)
    {
        $cuotas = Cuota::where('socio_id',$socio->id)->get();
        return view("socios.show", ["socio" => $socio,"cuotas" => $cuotas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Socio  $socio
     * @return \Illuminate\Http\Response
     */
    public function edit(Socio $socio)
    {
        return view("socios.edit", ["socio" => $socio]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Socio  $socio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Socio $socio)
    {
      $socio->fill($request->input());
      $socio->saveOrFail();
      return redirect()->route("socios.index")->with([
              "mensaje" => "¡Socio Actualizado con exito!",
              "tipo" => "success"
          ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Socio  $socio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Socio $socio)
    {
      $cuotas_anteriores = Cuota::where('socio_id',$socio->id)->where('activa',1)->get();
      if ($cuotas_anteriores->count() > 0) {
        foreach ($cuotas_anteriores as $cuota_anterior) {
          $cuota_anterior->activa = 0;
          $cuota_anterior->save();
        }
      }
      $socio->delete();
      return redirect()->route("socios.index")->with([
              "mensaje" => "¡Socio Eliminado con exito!",
              "tipo" => "danger"
          ]);
    }
}

<!-- resources/views/socios/modals/confirm-delte.blade.php -->

<div class="modal fade" id="modal-delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"  style="background-color: #dc3545;color: white;">
        <h4 class="modal-title">Eliminar Cliente</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Estas seguro que desea elimiar a <span id="nombre-socio"></span>?</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <form action="" method="post" id="form-eliminar-socio">
            @method("delete")
            @csrf
            <button type="submit" class="btn btn-danger">eliminar</button>
        </form>

      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- resources/views/socios/index.blade.php -->

@extends('layouts.master')
@section("h1", "Socios")

@section('content')
@include('notification')

  <div class="row">
    <div class="col-md-12">
      <a href="/socios/create" class="btn btn-success">Nuevo Socio</a>
    </div>
  </div>


  <div class="card-body">
    <table id="example1" class="table table-bordered ">
      <thead>
      <tr>
        <th>ID</th>
        <th>Nombre y apellido</th>
        <th>DNI</th>
        <th>fecha de ingreso</th>
        <th>Accion</th>
      </tr>
      </thead>
      <tbody>
        @foreach($socios as $socio)
        <tr>
          <td>{{$socio->id}}</td>
          <td>{{$socio->nombre}} {{$socio->apellido}}</td>
          <td>{{$socio->nro_doc}}</td>
          <td>{{$socio->fecha_ingreso}}</td>
          <td>

            <a class="btn btn-app btn-cuota" href="cuotas/create?socio_id={{$socio->id}}">
              <i class="fas fa-money-check-alt"></i> Cuota
            </a>

            <a class="btn btn-app btn-ver" href="{{route("socios.show",[$socio])}}">
              <i class="fas fa-eye"></i> Ver
            </a>
            <a class="btn btn-app btn-editar" href="{{route("socios.edit",[$socio])}}">
              <i class="fas fa-edit"></i> Editar
            </a>
            <a class="btn btn-app btn-eliminar" data-toggle="modal" data-idsocio="{{$socio->id}}" data-nombresocio="{{$socio->nombre}} {{$socio->apellido}}">
              <i class="fas fa-trash"></i> eliminar
            </a>
        </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@include('socios.modals.confirm-delete')
  <script type="text/javascript">
  $( document ).ready(function() {
      $("#example1").DataTable({
        responsive: true,
        language:{
    "processing": "Procesando...",
    "lengthMenu": "Mostrar _MENU_ registros",
    "zeroRecords": "No se encontraron resultados",
    "emptyTable": "Ningún dato disponible en esta tabla",
    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
    "search": "Buscar:",
    "infoThousands": ",",
    "loadingRecords": "Cargando...",
    "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
    },
    "aria": {
        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad",
        "collection": "Colección",
        "colvisRestore": "Restaurar visibilidad",
        "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
        "copySuccess": {
            "1": "Copiada 1 fila al portapapeles",
            "_": "Copiadas %d fila al portapapeles"
        },
        "copyTitle": "Copiar al portapapeles",
        "csv": "CSV",
        "excel": "Excel",
        "pageLength": {
            "-1": "Mostrar todas las filas",
            "1": "Mostrar 1 fila",
            "_": "Mostrar %d filas"
        },
        "pdf": "PDF",
        "print": "Imprimir"
    },
    "autoFill": {
        "cancel": "Cancelar",
        "fill": "Rellene todas las celdas con <i>%d<\/i>",
        "fillHorizontal": "Rellenar celdas horizontalmente",
        "fillVertical": "Rellenar celdas verticalmentemente"
    },
    "decimal": ",",
    "searchBuilder": {
        "add": "Añadir condición",
        "button": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
        },
        "clearAll": "Borrar todo",
        "condition": "Condición",
        "conditions": {
            "date": {
                "after": "Despues",
                "before": "Antes",
                "between": "Entre",
                "empty": "Vacío",
                "equals": "Igual a",
                "notBetween": "No entre",
                "notEmpty": "No Vacio",
                "not": "Diferente de"
            },
            "number": {
                "between": "Entre",
                "empty": "Vacio",
                "equals": "Igual a",
                "gt": "Mayor a",
                "gte": "Mayor o igual a",
                "lt": "Menor que",
                "lte": "Menor o igual que",
                "notBetween": "No entre",
                "notEmpty": "No vacío",
                "not": "Diferente de"
            },
            "string": {
                "contains": "Contiene",
                "empty": "Vacío",
                "endsWith": "Termina en",
                "equals": "Igual a",
                "notEmpty": "No Vacio",
                "startsWith": "Empieza con",
                "not": "Diferente de"
            },
            "array": {
                "not": "Diferente de",
                "equals": "Igual",
                "empty": "Vacío",
                "contains": "Contiene",
                "notEmpty": "No Vacío",
                "without": "Sin"
            }
        },
        "data": "Data",
        "deleteTitle": "Eliminar regla de filtrado",
        "leftTitle": "Criterios anulados",
        "logicAnd": "Y",
        "logicOr": "O",
        "rightTitle": "Criterios de sangría",
        "title": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
        },
        "value": "Valor"
    },
    "searchPanes": {
        "clearMessage": "Borrar todo",
        "collapse": {
            "0": "Paneles de búsqueda",
            "_": "Paneles de búsqueda (%d)"
        },
        "count": "{total}",
        "countFiltered": "{shown} ({total})",
        "emptyPanes": "Sin paneles de búsqueda",
        "loadMessage": "Cargando paneles de búsqueda",
        "title": "Filtros Activos - %d"
    },
    "select": {
        "1": "%d fila seleccionada",
        "_": "%d filas seleccionadas",
        "cells": {
            "1": "1 celda seleccionada",
            "_": "$d celdas seleccionadas"
        },
        "columns": {
            "1": "1 columna seleccionada",
            "_": "%d columnas seleccionadas"
        }
    },
    "thousands": ".",
    "datetime": {
        "previous": "Anterior",
        "next": "Proximo",
        "hours": "Horas",
        "minutes": "Minutos",
        "seconds": "Segundos",
        "unknown": "-",
        "amPm": [
            "am",
            "pm"
        ]
    },
    "editor": {
        "close": "Cerrar",
        "create": {
            "button": "Nuevo",
            "title": "Crear Nuevo Registro",
            "submit": "Crear"
        },
        "edit": {
            "button": "Editar",
            "title": "Editar Registro",
            "submit": "Actualizar"
        },
        "remove": {
            "button": "Eliminar",
            "title": "Eliminar Registro",
            "submit": "Eliminar",
            "confirm": {
                "_": "¿Está seguro que desea eliminar %d filas?",
                "1": "¿Está seguro que desea eliminar 1 fila?"
            }
        },
        "error": {
            "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
        },
        "multi": {
            "title": "Múltiples Valores",
            "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
            "restore": "Deshacer Cambios",
            "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
        }
    },
    "info": "Mostrando de _START_ a _END_ de _TOTAL_ entradas"
}
      });



  $( ".btn-eliminar" ).click(function() {
    $('#nombre-socio').html($(this).data("nombresocio"));
    $('#form-eliminar-socio').attr('action', 'socios/'+$(this).data("idsocio"))
  $('#modal-delete').modal('show');
});
});

  </script>
@endsection



# TODO:
el boton de eliminar socio no funciona correctamente cuando estamos en la seccion de socios lo elimina correctamente pero cunado filtramos por el buscador este no realiza ninuna accion

como te daras cuenta se trata de una aplicacion CRUD desarrollada en laravel