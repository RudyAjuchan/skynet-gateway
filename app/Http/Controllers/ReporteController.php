<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReporteVisitaMail;

class ReporteController extends Controller
{
    public function generarPDF(Request $request, $id)
    {
        // Soporte para token por query string (descarga en nueva pestaña)
        if ($request->has('token')) {
            $accessToken = PersonalAccessToken::findToken($request->token);
            if (!$accessToken) {
                return response()->json(['message' => 'Token inválido'], 401);
            }
            auth()->login($accessToken->tokenable);
        }

        $visita = Visita::with(['cliente', 'tecnico', 'supervisor', 'eventoVisita'])
            ->findOrFail($id);

        $pdf = Pdf::loadView('reportes.visita', compact('visita'));

        return $pdf->stream('reporte_visita_' . $visita->id . '.pdf');
    }


    public function enviarReporte(Request $request, $id)
    {
        // Autenticación manual con token (igual que en generar PDF)
        if ($request->has('token')) {
            $accessToken = PersonalAccessToken::findToken($request->token);
            if (!$accessToken) return response()->json(['message' => 'Token inválido'], 401);
            auth()->login($accessToken->tokenable);
        }

        $visita = Visita::with(['cliente', 'tecnico', 'supervisor', 'eventoVisita'])
            ->findOrFail($id);

        if (!$visita->cliente->correo_contacto) {
            return response()->json(['message' => 'El cliente no tiene correo registrado'], 400);
        }

        // Generar PDF en memoria sin guardarlo en disco
        $pdf = Pdf::loadView('reportes.visita', compact('visita'))->output();

        Mail::to($visita->cliente->correo_contacto)
            ->send(new ReporteVisitaMail($visita, $pdf));

        return response()->json(['message' => 'Reporte enviado al cliente exitosamente']);
    }
}
