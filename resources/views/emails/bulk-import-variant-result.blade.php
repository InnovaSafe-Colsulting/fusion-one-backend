<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 24px; }
        .summary { background: #f5f5f5; border-radius: 8px; padding: 16px; margin: 16px 0; }
        .ok  { color: #16a34a; font-weight: bold; }
        .err { color: #dc2626; font-weight: bold; }
    </style>
</head>
<body>
<div class="container">
    <h2>Importación masiva de variantes</h2>
    <p>Hola <strong>{{ $userName }}</strong>, tu importación ha finalizado.</p>
    <div class="summary">
        <p>✅ Registros importados correctamente: <span class="ok">{{ $registersOk }}</span></p>
        <p>❌ Registros con error: <span class="err">{{ $errorsCount }}</span></p>
    </div>
    @if($errorsCount > 0)
        <p>Se adjunta <strong>errores_variantes.xlsx</strong> con los registros que fallaron y el motivo del error en la última columna.</p>
    @else
        <p>🎉 Todos los registros fueron importados sin errores.</p>
    @endif
    <p style="color:#999; font-size:12px;">Este correo fue generado automáticamente.</p>
</div>
</body>
</html>
