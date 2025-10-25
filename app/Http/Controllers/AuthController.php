<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('correo', $request->correo)->first();

        if (!$user || !Hash::check($request->contraseña, $request->contraseña)) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }

        return [
            'token' => $user->createToken('auth_token')->plainTextToken,
            'user' => $user
        ];
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return ['message' => 'Sesión cerrada'];
    }

    public function me(Request $request)
    {
        return $request->user();
    }
}

