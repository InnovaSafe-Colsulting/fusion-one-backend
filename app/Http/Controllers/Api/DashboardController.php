<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;

class DashboardController extends Controller
{
    public function __construct(private DashboardService $dashboardService) {}

    public function salesSummary(): JsonResponse
    {
        return response()->json($this->dashboardService->getSalesSummary());
    }

    public function cashSummary(): JsonResponse
    {
        return response()->json($this->dashboardService->getCashSummary());
    }

    public function tablesSummary(Request $request): JsonResponse
    {
        $tenantId = JWTAuth::parseToken()->getPayload()->get('tenantId');
        $branchId = (int) $request->query('branch_id');

        if (! $branchId) {
            return response()->json(['message' => 'branch_id is required'], 422);
        }

        return response()->json($this->dashboardService->getTablesSummary($tenantId, $branchId));
    }

    public function kitchenSummary(Request $request): JsonResponse
    {
        $tenantId = JWTAuth::parseToken()->getPayload()->get('tenantId');
        $branchId = (int) $request->query('branch_id');

        if (! $branchId) {
            return response()->json(['message' => 'branch_id is required'], 422);
        }

        return response()->json($this->dashboardService->getKitchenSummary($tenantId, $branchId));
    }

    public function kitchenOrders(Request $request): JsonResponse
    {
        $tenantId = JWTAuth::parseToken()->getPayload()->get('tenantId');
        $branchId = (int) $request->query('branch_id');

        if (! $branchId) {
            return response()->json(['message' => 'branch_id is required'], 422);
        }

        return response()->json($this->dashboardService->getKitchenOrders($tenantId, $branchId));
    }

    public function salesByHour(Request $request): JsonResponse
    {
        $tenantId = JWTAuth::parseToken()->getPayload()->get('tenantId');
        $branchId = (int) $request->query('branch_id');

        if (! $branchId) {
            return response()->json(['message' => 'branch_id is required'], 422);
        }

        return response()->json($this->dashboardService->getSalesByHour($tenantId, $branchId));
    }

    public function criticalInventory(Request $request): JsonResponse
    {
        $tenantId = JWTAuth::parseToken()->getPayload()->get('tenantId');
        $branchId = (int) $request->query('branch_id');

        if (! $branchId) {
            return response()->json(['message' => 'branch_id is required'], 422);
        }

        return response()->json($this->dashboardService->getCriticalInventory($tenantId, $branchId));
    }

    public function recentActivity(Request $request): JsonResponse
    {
        $tenantId = JWTAuth::parseToken()->getPayload()->get('tenantId');
        $branchId = (int) $request->query('branch_id');
        $limit    = $request->query('limit') !== null ? (int) $request->query('limit') : null;

        if (! $branchId) {
            return response()->json(['message' => 'branch_id is required'], 422);
        }

        return response()->json($this->dashboardService->getRecentActivity($tenantId, $branchId, $limit));
    }

    public function topProducts(Request $request): JsonResponse
    {
        $tenantId = JWTAuth::parseToken()->getPayload()->get('tenantId');
        $branchId = (int) $request->query('branch_id');
        $date     = $request->query('date', Carbon::today()->toDateString());
        $limit    = (int) $request->query('limit', 10);

        if (! $branchId) {
            return response()->json(['message' => 'branch_id is required'], 422);
        }

        return response()->json($this->dashboardService->getTopProducts($tenantId, $branchId, $date, $limit));
    }
}
