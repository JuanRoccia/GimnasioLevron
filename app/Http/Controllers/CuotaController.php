<?php

namespace App\Http\Controllers;
use Mail;
use App\Cuota;
use App\Socio;
use Illuminate\Http\Request;

class CuotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $cuotas = Cuota::with('socio')->where('activa',1)->get();

      //return $cuotas;
      return view('cuotas.index',compact('cuotas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $socio = Socio::findorFail($request->socio_id);

      return view("cuotas.create", ["socio" => $socio]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        $cuotas_anteriores = Cuota::where('socio_id',$request->socio_id)->where('activa',1)->get();
        if ($cuotas_anteriores->count() > 0) {
          foreach ($cuotas_anteriores as $cuota_anterior) {
            $cuota_anterior->activa = 0;
            $cuota_anterior->save();
          }
        }
        $cuota = new Cuota($request->input());
        $cuota->saveOrFail();

        return redirect()->route("cuotas.index")->with([
                "mensaje" => "¡Cuota registrada con exito!",
                "tipo" => "success"
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function show(Cuota $cuota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuota $cuota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuota $cuota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuota $cuota)
    {
      $socio_id = $cuota->socio_id;
      $cuota->delete();
      return redirect()->route("socios.show",[$socio_id])->with([
              "mensaje" => "¡Cuota Eliminada con exito!",
              "tipo" => "danger"
          ]);
    }

    function enviaremail(){

      $Date = date("Y-m-d H:i:s");
      $proximas_a_vencer = date('Y-m-d', strtotime($Date. ' + 5 days'));

          $cuotas = Cuota::with('socio')
                          ->where('activa',1)
                          ->where('fecha_hasta','<',$proximas_a_vencer)
                          ->where('notificado','=',0)
                          ->get();
          //return $cuotas;

          foreach ($cuotas as $cuota) {

            $fromEmail = 'no_responder@gimnasiolevron.com.ar';
            $fromName = 'Gimnasio Levron';
            $clienteEmail = $cuota->socio->mail;
            $data = array();
            $socio = Socio::findorFail($cuota->socio->id);
            $cuota->notificado = 1;
            $cuota->save();
            //return $socio;
            try
            {
                Mail::send('emails.plantillaemail',compact('socio'), function($message) use ($clienteEmail, $fromName, $fromEmail){
                    $message->to($clienteEmail);
                    $message->bcc('paezpablo2@gmail.com');
                    $message->from($fromEmail, $fromName);
                    $message->subject('Cuota proxima a vencer');
                });

                $resultado = 0;

                if( count(Mail::failures()) > 0 ) {

                   $resultado = 0;

                   /*foreach(Mail::failures as $email_address) {
                       echo " - $email_address <br />";
                    }*/

                } else {
                    $resultado = 1;
                }

                return $resultado;
            }
            catch (\Exception $e)
            {
                dd($e->getMessage());
            }
          }


      }

}
