@component('mail::message')
# Reporte de Visita

Hola {{ $visita->cliente->nombre }},

Adjunto encontrará el reporte de la visita programada con nuestro técnico **{{ $visita->tecnico->nombre }}**.

**Fecha:** {{ $visita->fecha_programada }}  
**Estado:** {{ ucfirst($visita->estado_visita) }}

Gracias por confiar en SkyNet.

Saludos,  
**Equipo de Soporte SkyNet**
@endcomponent
