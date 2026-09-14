<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; background: #fff; border-radius: 8px; padding: 40px; }
        .btn { display: inline-block; padding: 12px 28px; background: #4F46E5; color: #ffffff !important; text-decoration: none; border-radius: 6px; font-weight: bold; margin-top: 24px; }
        .footer { margin-top: 32px; font-size: 12px; color: #999; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Restablece tu contraseña</h2>
        <p>Recibimos una solicitud para restablecer la contraseña de tu cuenta. Haz clic en el botón para continuar:</p>
        <a href="{{ $resetLink }}" class="btn">Restablecer contraseña</a>
        <p style="margin-top: 24px;">Si no solicitaste este cambio, puedes ignorar este correo. El enlace expirará en 60 minutos.</p>
        <div class="footer">FusionOne - InnovaSafe</div>
    </div>
</body>
</html>
