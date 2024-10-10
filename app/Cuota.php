<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuota extends Model
{
  protected $fillable = [

       'socio_id',
        'fecha_desde',
        'fecha_hasta',
        'fecha_pago',
        'importe',
        'activa',
        'notificado'


  ];

  public function socio()
    {
        return $this->belongsTo("App\Socio", "socio_id");
    }
}
