<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
  protected $fillable = [

       'tipo_doc',
        'nro_doc',
        'apellido',
        'nombre',
        'calle',
        'numero',
        'piso',
        'dpto',
        'codigo_postal',
        'codigo_area',
        'telefono',
        'mail',
        'fecha_ingreso',

  ];

  public function cuotas()
    {
        return $this->belongsTo("App\Cuota","id", "socio_id");
    }
}
