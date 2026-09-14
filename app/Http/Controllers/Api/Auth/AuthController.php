<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\SendMfaEmailRequest;
use App\Http\Requests\Auth\SendMfaWhatsappRequest;
use App\Http\Requests\Auth\VerifyMfaRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService) {}

    public function login(LoginRequest $request): JsonResponse
    {
        $result = $this->authService->login($request->email, $request->password);

        if (isset($result['error'])) {
            return response()->json(['message' => $result['error']], $result['status']);
        }

        return response()->json($result);
    }

    public function sendEmail(SendMfaEmailRequest $request): JsonResponse
    {
        $this->authService->sendMfaCode($request->email);
        return response()->json(['message' => 'Code sent']);
    }

    public function sendWhatsapp(SendMfaWhatsappRequest $request): JsonResponse
    {
        $this->authService->sendMfaCodeWhatsapp($request->phone);
        return response()->json(['message' => 'Code sent']);
    }

    public function verifyMfa(VerifyMfaRequest $request): JsonResponse
    {
        $result = $this->authService->verifyMfa($request->code, $request->tempToken);
        if (isset($result['error'])) {
            return response()->json(['message' => $result['error']], $result['status']);
        }

        return response()->json($result);
    }

    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        $this->authService->forgotPassword($request->email);
        return response()->json(['message' => 'Si el correo existe, recibirás un enlace para restablecer tu contraseña.']);
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $result = $this->authService->resetPassword($request->email, $request->token, $request->password);

        if (isset($result['error'])) {
            return response()->json(['message' => $result['error']], $result['status']);
        }

        return response()->json($result);
    }
}
