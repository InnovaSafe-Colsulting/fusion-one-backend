<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="font-family: sans-serif; padding: 32px; color: #333;">
    <h2>FusionOne | InnovaSafe — Código de Verificación</h2>
    <p>Use el siguiente código para completar su login. Expira en {{ config('auth.mfa_ttl', 10) }} minutos.</p>
    <div style="font-size: 36px; font-weight: bold; letter-spacing: 8px; margin: 24px 0; color: #1a1a1a;">
        {{ $code }}
    </div>
    <p style="color: #888; font-size: 13px;">Si usted no envio este código, por favor ignore este correo.</p>
</body>
</html>
