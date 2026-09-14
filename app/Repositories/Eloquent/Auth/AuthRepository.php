<?php

namespace App\Repositories\Eloquent\Auth;

use App\Models\MfaCode;
use App\Models\User;
use App\Repositories\Interfaces\Auth\AuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{
    public function findUserByEmail(string $email): ?User
    {
        return User::where('email', $email)->where('is_active', true)->first();
    }

    public function findUserByPhone(string $phone): ?User
    {
        return User::where('cellphone', $phone)->where('is_active', true)->first();
    }

    public function updateLastLogin(int $userId): void
    {
        User::where('id', $userId)->update(['last_login_at' => now()]);
    }

    public function invalidatePreviousCodes(int $userId): void
    {
        MfaCode::where('user_id', $userId)
            ->where('used', false)
            ->where('expires_at', '>', now())
            ->update(['used' => true]);
    }

    public function createMfaCode(int $userId, string $email, string $code): MfaCode
    {
        return MfaCode::create([
            'user_id'    => $userId,
            'email'      => $email,
            'code'       => Hash::make($code),
            'used'       => false,
            'expires_at' => now()->addMinute(),
        ]);
    }

    public function findValidMfaCode(int $userId): ?MfaCode
    {
        return MfaCode::where('user_id', $userId)
            ->where('used', false)
            ->where('expires_at', '>', now())
            ->latest()
            ->first();
    }

    public function markMfaCodeUsed(MfaCode $mfaCode): void
    {
        $mfaCode->update(['used' => true]);
    }

    public function updatePassword(int $userId, string $password): void
    {
        User::where('id', $userId)->update(['password' => Hash::make($password)]);
    }
}
