<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitaController extends Controller
{
    public function index(Request $request)
    {
        $usuario = $request->user();

        // Si es Supervisor → devuelve todas
        if ($usuario->rol->nombre === 'Supervisor') {
            return Visita::with(['cliente', 'tecnico', 'supervisor', 'eventoVisita'])
                ->where('estado', 1)
                ->get();
        }

        // Si es Técnico → solo las asignadas a él
        if ($usuario->rol->nombre === 'Tecnico') {
            return Visita::with(['cliente', 'tecnico', 'supervisor','eventoVisita'])
                ->where('estado', 1)
                ->where('tecnico_id', $usuario->id)
                ->get();
        }

        return response()->json(['message' => 'No autorizado'], 403);
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'tecnico_id' => 'required|exists:usuarios,id',
            'supervisor_id' => 'required|exists:usuarios,id',
            'fecha_programada' => 'required|date'
        ]);

        return Visita::create([
            'cliente_id' => $request->cliente_id,
            'supervisor_id' => $request->supervisor_id,
            'tecnico_id' => $request->tecnico_id,
            'fecha_programada' => $request->fecha_programada,
            'estado_visita' => 'pendiente',
            'estado' => 1
        ]);
    }

    public function update(Request $request, $id)
    {
        $visita = Visita::findOrFail($id);

        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'supervisor_id' => 'required|exists:usuarios,id',
            'tecnico_id' => 'required|exists:usuarios,id',
            'fecha_programada' => 'required|date',
            'estado_visita' => 'required|string'
        ]);

        $visita->update($request->all());

        return response()->json([
            'message' => 'Visita actualizada correctamente',
            'visita' => $visita
        ]);
    }

    public function destroy($id)
    {
        $visita = Visita::findOrFail($id);
        $visita->estado = 0;
        $visita->updated_at = now();
        $visita->save();

        return response()->json([
            'message' => 'Visita eliminada correctamente'
        ]);
    }
}
