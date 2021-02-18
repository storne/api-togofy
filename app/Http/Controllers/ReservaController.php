<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try{

            $reservas = Reserva::all();
            return response()->json(['data' => $reservas, 'message' => 'Exitoso']);

        }catch (\Exception $e) {
            return $this->throwGenericException($e);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $reservado = $this->horarioReservado($request);
        if($reservado){
            return response()->json(['data' => $reservado, 'message' => 'Reserva ocupada']);
            
        }else{
            try{

                $reserva = new Reserva();
                $reserva->fecha = $request->fecha;
                $reserva->hora_inicio = $request->hora_inicio;
                $reserva->hora_fin = $request->hora_fin;
                $reserva->motivo = $request->motivo;
                $reserva->sala_id = $request->sala_id;
                $reserva->servicios = $request->servicios;
                $reserva->save();
                return response()->json(['data' => $reserva, 'message' => 'Exitoso']);
    
            }catch (\Exception $e) {
                return $this->throwGenericException($e);
            }
           
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try{

            $reserva = Reserva::find($id);
            return response()->json(['data' => $reserva, 'message' => 'Exitoso']);

        }catch (\Exception $e) {
            return $this->throwGenericException($e);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $reservado = $this->horarioReservado($request);
        if($reservado){
            return response()->json(['data' => $reservado, 'message' => 'Reserva ocupada']);
            
        }else{
            try{

                $reserva = Reserva::find($id);
                $reserva->fecha = $request->fecha;
                $reserva->hora_inicio = $request->hora_inicio;
                $reserva->hora_fin = $request->hora_fin;
                $reserva->motivo = $request->motivo;
                $reserva->sala_id = $request->sala_id;
                $reserva->servicios = $request->servicios;
                $reserva->save();
                return response()->json(['data' => $reserva, 'message' => 'Reserva modificada']);
    
            }catch (\Exception $e) {
                return $this->throwGenericException($e);
            }
           
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try{

            $reserva = Reserva::find($id);
            $reserva->delete();
            return response()->json(['data' => $reserva, 'message' => 'Reserva eliminada']);

        }catch (\Exception $e) {
            return $this->throwGenericException($e);
        }
    }


    private function horarioReservado($request){
        $reservado = false;
        $reserva_inicial = Reserva::where('fecha',$request->fecha)
        ->where('sala_id',$request->sala_id)
        ->where('hora_inicio','<=',$request->hora_inicio)
        ->where('hora_fin','>=',$request->hora_inicio)
        ->count();
        if($reserva_inicial > 0){
            $reservado = true;
        }

        $reserva_final = Reserva::where('fecha',$request->fecha)
        ->where('sala_id',$request->sala_id)
        ->where('hora_inicio','<=',$request->hora_fin)
        ->where('hora_fin','>=',$request->hora_fin)
        ->count();
        if($reserva_final > 0){
            $reservado = true;
        }

        $reserva_inicial_final = Reserva::where('fecha',$request->fecha)
        ->where('sala_id',$request->sala_id)
        ->where('hora_inicio','>=',$request->hora_inicio)
        ->where('hora_fin','<=',$request->hora_fin)
        ->count();
        if($reserva_inicial_final > 0){
            $reservado = true;
        }

        return $reservado;

    }
}
