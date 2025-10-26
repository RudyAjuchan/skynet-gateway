<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TecnicosController extends Controller
{
    private $ROL_TECNICO = 2; // 👈 Ajusta según tu BD

    public function index()
    {
        return Usuario::where('estado', 1)
            ->where('rol_id', $this->ROL_TECNICO)
            ->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'correo' => 'required|email|unique:usuarios,correo',
            'password' => 'required|min:6'
        ]);

        Usuario::create([
            'rol_id' => $this->ROL_TECNICO,
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'password' => Hash::make($request->password),
            'estado' => 1
        ]);

        return response()->json(['message' => 'Técnico creado correctamente'], 201);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'correo' => "required|email|unique:usuarios,correo,$id",
            'password' => 'nullable|min:6'
        ]);

        $tecnico = Usuario::where('rol_id', $this->ROL_TECNICO)->findOrFail($id);

        $tecnico->nombre = $request->nombre;
        $tecnico->correo = $request->correo;

        if ($request->password) {
            $tecnico->password = Hash::make($request->password);
        }

        $tecnico->save();

        return response()->json(['message' => 'Técnico actualizado correctamente']);
    }

    public function destroy($id)
    {
        $tecnico = Usuario::where('rol_id', $this->ROL_TECNICO)->findOrFail($id);

        $tecnico->estado = 0;
        $tecnico->save();

        return response()->json(['message' => 'Técnico eliminado correctamente']);
    }
}
