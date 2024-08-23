@extends('layouts.master')
@section("h1", "Cuotas")

@section('content')
@include('notification')
<style media="screen">
  .tr-vencida td{
    border: 2px solid red!important;

    border-right: 1px!important;
  }
  .tr-por-vencer td{
    border: 2px solid #ffc107!important;

    border-right: 1px!important;
  }

</style>
  <div class="row">
    <div class="col-sm-6"><label for="selectConcepto">Estados</label>
      <select id="selectEstados" name="selectEstados" class="form-control">
        <option value="">
          TODOS
        </option>
      </select>
    </div>
  </div>
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>Nombre y apellido</th>
        <th>DNI</th>
        <th>Fecha de pago</th>
        <th>Periodo</th>
        <th>Dias restantes</th>
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
           <td>{{$cuota->socio->nombre}} {{$cuota->socio->apellido}}</td>
           <td>{{$cuota->socio->nro_doc}}</td>
           <td>{{date("d/m/Y", strtotime($cuota->fecha_pago))}}</td>
           <td>{{date("d/m/Y", strtotime($cuota->fecha_desde))}} - {{date("d/m/Y", strtotime($cuota->fecha_hasta))}}</td>
           <td>{{$dias_restantes}}</td>
           <td>Por vencer</td>
           <td class="text-right text-monospace">${{ number_format($cuota->importe, 2, ',', '.') }}</td>
           <td>
             <a class="btn btn-app btn-cuota" href="cuotas/create?socio_id={{$cuota->socio->id}}">
               <i class="fas fa-money-check-alt"></i> Cuota
             </a>

             <a class="btn btn-app btn-ver" href="{{route("socios.show",[$cuota->socio])}}">
               <i class="fas fa-eye"></i> Ver
             </a>
           </td>
         </tr>
         @else
           @if($dias_restantes < 0) <!-- cuota vencida  -->
           <tr class="tr-vencida">
             <td>{{$cuota->socio->nombre}} {{$cuota->socio->apellido}}</td>
             <td>{{$cuota->socio->nro_doc}}</td>
             <td>{{date("d/m/Y", strtotime($cuota->fecha_pago))}}</td>
             <td>{{date("d/m/Y", strtotime($cuota->fecha_desde))}} - {{date("d/m/Y", strtotime($cuota->fecha_hasta))}}</td>
             <td>Vencida</td>
             <td>Vencida</td>
             <td class="text-right text-monospace">${{ number_format($cuota->importe, 2, ',', '.') }}</td>
             <td>
               <a class="btn btn-app btn-cuota" href="cuotas/create?socio_id={{$cuota->socio->id}}">
                 <i class="fas fa-money-check-alt"></i> Cuota
               </a>

               <a class="btn btn-app btn-ver" href="{{route("socios.show",[$cuota->socio])}}">
                 <i class="fas fa-eye"></i> Ver
               </a>
             </td>
           </tr>
           @else
           <tr>
             <td>{{$cuota->socio->nombre}} {{$cuota->socio->apellido}}</td>
             <td>{{$cuota->socio->nro_doc}}</td>
             <td>{{date("d/m/Y", strtotime($cuota->fecha_pago))}}</td>
             <td>{{date("d/m/Y", strtotime($cuota->fecha_desde))}} - {{date("d/m/Y", strtotime($cuota->fecha_hasta))}}</td>
             <td>{{$dias_restantes}}</td>
             <td>Habilitado</td>
             <td class="text-right text-monospace">${{ number_format($cuota->importe, 2, ',', '.') }}</td>
             <td>
               <a class="btn btn-app btn-cuota" href="cuotas/create?socio_id={{$cuota->socio->id}}">
                 <i class="fas fa-money-check-alt"></i> Cuota
               </a>

               <a class="btn btn-app btn-ver" href="{{route("socios.show",[$cuota->socio])}}">
                 <i class="fas fa-eye"></i> Ver
               </a>

             </td>
           </tr>
           @endif
         @endif

        @endforeach
      </tbody>
    </table>
  </div>

  <script type="text/javascript">
  $( document ).ready(function() {
      $("#example1").DataTable({
        responsive: true,
        initComplete: function () {
            this.api().columns(5).every( function () {
              var column = this;
              var select = $('#selectEstados')

                  .on( 'change', function () {
                      var val = $.fn.dataTable.util.escapeRegex(
                          $(this).val()
                      );

                      column
                          .search( val ? '^'+val+'$' : '', true, false )
                          .draw();
                  } );

              column.data().unique().sort().each( function ( d, j ) {
                  select.append( '<option value="'+d+'">'+d+'</option>' )
              } );
          } );
        },
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
