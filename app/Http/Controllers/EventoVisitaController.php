<?php

namespace App\Http\Controllers;

use App\Models\Evento_visita;
use App\Models\Visita;
use Illuminate\Http\Request;

class EventoVisitaController extends Controller
{
    public function registrarEvento(Request $request, $id)
    {
        $request->validate([
            'tipo_evento' => 'required|string',
            'notas' => 'nullable|string',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
        ]);

        Evento_visita::create([
            'visita_id' => $id,
            'tipo_evento' => $request->tipo_evento,
            'notas' => $request->notas,
            'fecha_hora' => now(),
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'estado' => 1,
        ]);

        return response()->json(['message' => 'Evento registrado correctamente']);
    }

    public function finalizarVisita(Request $request, $id)
    {
        $visita = Visita::findOrFail($id);
        $visita->estado_visita = 'completada';
        $visita->updated_at = now();
        $visita->save();

        return response()->json(['message' => 'Visita marcada como completada']);
    }
}
