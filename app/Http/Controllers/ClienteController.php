<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Listar clientes activos
     */
    public function index()
    {
        return Cliente::where('estado', 1)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'direccion' => 'required|string|max:255',
            'telefono_contacto' => 'required|string|max:50',
            'correo_contacto' => 'required|email|max:150',
        ]);

        Cliente::create([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'telefono_contacto' => $request->telefono_contacto,
            'correo_contacto' => $request->correo_contacto,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'estado' => 1,
        ]);

        return response()->json(['message' => 'Cliente creado correctamente'], 201);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'direccion' => 'required|string|max:255',
            'telefono_contacto' => 'required|string|max:50',
            'correo_contacto' => 'required|email|max:150',
        ]);

        $cliente = Cliente::findOrFail($id);

        $cliente->update([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'telefono_contacto' => $request->telefono_contacto,
            'correo_contacto' => $request->correo_contacto,
        ]);

        return response()->json(['message' => 'Cliente actualizado correctamente']);
    }


    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);

        $cliente->estado = 0;
        $cliente->save();

        return response()->json(['message' => 'Cliente eliminado correctamente']);
    }
}
