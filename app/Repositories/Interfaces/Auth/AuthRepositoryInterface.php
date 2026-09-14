<?php

namespace App\Repositories\Interfaces\Auth;

use App\Models\MfaCode;
use App\Models\User;

interface AuthRepositoryInterface
{
    public function findUserByEmail(string $email): ?User;
    public function findUserByPhone(string $phone): ?User;
    public function updateLastLogin(int $userId): void;
    public function invalidatePreviousCodes(int $userId): void;
    public function createMfaCode(int $userId, string $email, string $code): MfaCode;
    public function findValidMfaCode(int $userId): ?MfaCode;
    public function markMfaCodeUsed(MfaCode $mfaCode): void;
    public function updatePassword(int $userId, string $password): void;
}
