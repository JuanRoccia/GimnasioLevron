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
