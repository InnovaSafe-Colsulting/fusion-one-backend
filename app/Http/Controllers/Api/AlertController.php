<?php

namespace App\Http\Controllers\Api;

use App\Enums\AlertType;
use App\Http\Controllers\Controller;
use App\Services\AlertService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AlertController extends Controller
{
    public function __construct(private AlertService $alertService) {}

    public function index(Request $request): JsonResponse
    {
        $tenantId = JWTAuth::parseToken()->getPayload()->get('tenantId');
        $branchId = (int) $request->query('branch_id');
        $limit    = $request->query('limit') !== null ? (int) $request->query('limit') : null;

        if (! $branchId) {
            return response()->json(['message' => 'branch_id is required'], 422);
        }

        return response()->json($this->alertService->getActiveAlerts($tenantId, $branchId, $limit));
    }

    public function types(): JsonResponse
    {
        $types = collect(AlertType::cases())->map(fn($case) => [
            'type'     => $case->value,
            'label'    => $case->label(),
            'severity' => $case->severity(),
        ])->values();

        return response()->json($types);
    }
}
