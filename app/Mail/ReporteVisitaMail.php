<?php

namespace App\Mail;

use App\Models\Visita;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReporteVisitaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $visita;
    public $pdf;

    public function __construct(Visita $visita, $pdf)
    {
        $this->visita = $visita;
        $this->pdf = $pdf;
    }

    public function build()
    {
        return $this->subject('Reporte de Visita #' . $this->visita->id)
            ->markdown('emails.reporte-visita')
            ->attachData($this->pdf, 'reporte_visita_'.$this->visita->id.'.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
