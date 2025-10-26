<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Visita</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; }

        .header {
            background: #0D47A1;
            color: white;
            padding: 14px;
            text-align: center;
        }

        .header img {
            height: 50px;
            margin-bottom: 6px;
        }

        .section-title {
            margin-top: 25px;
            font-size: 16px;
            font-weight: bold;
            border-bottom: 2px solid #0D47A1;
            padding-bottom: 4px;
            color: #0D47A1;
        }

        .info-table {
            width: 100%;
            margin-top: 10px;
        }
        .info-table td {
            padding: 6px 0;
        }

        table {
            width: 100%;
            margin-top: 12px;
            border-collapse: collapse;
        }
        th {
            background: #0D47A1;
            color: white;
            padding: 6px;
            text-align: left;
        }
        td {
            padding: 6px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background: #f6f6f6;
        }

        .footer {
            margin-top: 35px;
            text-align: center;
            font-size: 11px;
            color: #777;
        }
    </style>
</head>
<body>

<div class="header">
    <img src="{{ public_path('img/skyNet.png') }}" alt="Logo">
    <h2>Reporte de Visita #{{ $visita->id }}</h2>
</div>

<div class="section-title">Información General</div>
<table class="info-table">
    <tr>
        <td><strong>Cliente:</strong> {{ $visita->cliente->nombre }}</td>
        <td><strong>Técnico:</strong> {{ $visita->tecnico->nombre }}</td>
    </tr>
    <tr>
        <td><strong>Supervisor:</strong> {{ $visita->supervisor->nombre }}</td>
        <td><strong>Fecha Programada:</strong> {{ $visita->fecha_programada }}</td>
    </tr>
    <tr>
        <td><strong>Estado:</strong> {{ ucfirst($visita->estado_visita) }}</td>
    </tr>
</table>

<div class="section-title">Eventos Registrados</div>

@if($visita->eventoVisita->count())
<table>
    <thead>
        <tr>
            <th>Tipo de Evento</th>
            <th>Fecha / Hora</th>
            <th>Notas</th>
        </tr>
    </thead>
    <tbody>
    @foreach($visita->eventoVisita as $ev)
        <tr>
            <td>{{ $ev->tipo_evento }}</td>
            <td>{{ $ev->fecha_hora }}</td>
            <td>{{ $ev->notas }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@else
<p>No se han registrado eventos aún.</p>
@endif

<div class="footer">
    <p>Generado automáticamente por SkyNet · {{ now()->format('d/m/Y H:i') }}</p>
</div>

</body>
</html>
