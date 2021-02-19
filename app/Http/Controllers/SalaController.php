<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try{

            $salas = Sala::all();

            foreach ($salas as $key) {
                $key->reservas;
            }
            return response()->json(['data' => $salas, 'message' => 'Exitoso']);

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
        try{

            $sala = new Sala();

            $sala->nombre = $request->nombre;
            $sala->descripcion = $request->descripcion;

            $sala->save();

            return response()->json(['data' => $sala, 'message' => 'Exitoso']);

        }catch (\Exception $e) {
            return $this->throwGenericException($e);
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

            $sala = Sala::find($id);
            return response()->json(['data' => $sala, 'message' => 'Exitoso']);

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
    public function update(Request $request,$id)
    {
        
        try{

            $sala = Sala::find($id);

            $sala->nombre = $request->nombre;
            $sala->descripcion = $request->descripcion;

            $sala->save();

            return response()->json(['data' => $sala, 'message' => 'Exitoso']);

        }catch (\Exception $e) {
            return $this->throwGenericException($e);
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

            $sala = Sala::find($id);
            $sala->delete();

            return response()->json(['data' => $sala, 'message' => 'Sala Eliminada']);

        }catch (\Exception $e) {
            return $this->throwGenericException($e);
        }
    }
}
