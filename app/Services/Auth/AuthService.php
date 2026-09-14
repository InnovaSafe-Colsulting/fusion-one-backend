<?php

namespace App\Services\Auth;

use App\Mail\MfaCodeMail;
use App\Mail\ResetPasswordMail;
use App\Repositories\Interfaces\Auth\AuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class AuthService
{
    public function __construct(private AuthRepositoryInterface $authRepository) {}

    public function login(string $email, string $password): array
    {
        $user = $this->authRepository->findUserByEmail($email);

        if (! $user || ! Hash::check($password, $user->password)) {
            return ['error' => 'Invalid credentials', 'status' => 401];
        }

        return [
            'requiresMfa' => true,
            'tempToken'   => $this->generateTempToken($user->id),
        ];
    }

    public function sendMfaCode(string $email): void
    {

        Log::debug('ENTRANDO A sendMfaCode', [
            'email' => $email,
        ]);

        $user  = $this->authRepository->findUserByEmail($email);
        $plain = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $this->authRepository->invalidatePreviousCodes($user->id);
        $this->authRepository->createMfaCode($user->id, $email, $plain);

        Mail::to($email)->send(new MfaCodeMail($plain));

        Log::debug('MFA code generated', ['email' => $email, 'code' => $plain]);
    }

    public function sendMfaCodeWhatsapp(string $phone): void
    {
        $user  = $this->authRepository->findUserByPhone($phone);
        $plain = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $this->authRepository->invalidatePreviousCodes($user->id);
        $this->authRepository->createMfaCode($user->id, $user->email, $plain);

        Log::info("MFA WhatsApp code for {$phone}: {$plain}");
    }

    public function verifyMfa(string $code, string $tempToken): array
    {
        try {
            $payload = JWTAuth::setToken($tempToken)->getPayload();
        } catch (\Exception) {
            return ['error' => 'Invalid or expired token', 'status' => 401];
        }

        if (! $payload->get('mfa_pending')) {
            return ['error' => 'Invalid token type', 'status' => 401];
        }

        $userId  = $payload->get('sub');
        $mfaCode = $this->authRepository->findValidMfaCode($userId);

        if (! $mfaCode || ! Hash::check($code, $mfaCode->code)) {
            return ['error' => 'Invalid or expired MFA code', 'status' => 401];
        }

        $this->authRepository->markMfaCodeUsed($mfaCode);
        $this->authRepository->updateLastLogin($userId);

        $user = $mfaCode->user;

        return [
            'accessToken' => $this->generateAccessToken($user),
            'tenantId'    => $user->tenant_id,
            'user'        => [
                'id'    => $user->id,
                'name'  => "{$user->first_name} {$user->last_name}",
                'email' => $user->email,
                'role'  => $user->roles()->first()?->name ?? 'user',
            ],
        ];
    }

    public function forgotPassword(string $email): void
    {
        $user = $this->authRepository->findUserByEmail($email);

        if (! $user) {
            return;
        }

        $token     = Password::createToken($user);
        $resetLink = config('app.frontend_url') . '/auth/reset-password?token=' . $token . '&email=' . urlencode($email);
        Log::info($resetLink);

        Mail::to($email)->send(new ResetPasswordMail($resetLink));
    }

    public function resetPassword(string $email, string $token, string $password): array
    {
        $user = $this->authRepository->findUserByEmail($email);

        if (! $user) {
            return ['error' => 'Usuario no encontrado.', 'status' => 404];
        }

        if (! Password::tokenExists($user, $token)) {
            return ['error' => 'El enlace de restablecimiento es inválido o ha expirado.', 'status' => 422];
        }

        $this->authRepository->updatePassword($user->id, $password);
        Password::deleteToken($user);

        return ['message' => '¡Contraseña actualizada exitosamente! Ya puedes iniciar sesión con tu nueva contraseña.'];
    }

    private function generateTempToken(int $userId): string
    {
        $claims = JWTFactory::sub($userId)
            ->mfa_pending(true)
            ->setTTL((int) config('auth.temp_token_ttl', 5))
            ->make();

        return JWTAuth::encode($claims)->get();
    }

    private function generateAccessToken($user): string
    {
        $claims = JWTFactory::sub($user->id)
            ->email($user->email)
            ->role($user->roles()->first()?->name ?? 'user')
            ->tenantId($user->tenant_id)
            ->setTTL((int) config('auth.access_token_ttl', 480))
            ->make();

        return JWTAuth::encode($claims)->get();
    }
}
