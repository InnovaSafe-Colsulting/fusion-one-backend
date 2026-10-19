<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\TenantService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class TenantController extends Controller
{
    public function __construct(private TenantService $service) {}

    public function index(Request $request): JsonResponse
    {
        return response()->json($this->service->getAll($request->all()));
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->service->getById($id));
    }

    public function store(Request $request): JsonResponse
    {
        return response()->json($this->service->create($request->all()), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        return response()->json($this->service->update($id, $request->all()));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }

    public function toggleStatus(int $id): JsonResponse
    {
        try {
            $status = (int) request()->input('status');
            $tenant = $this->service->toggleStatus($id, $status);
            return response()->json(['message' => 'Estado actualizado correctamente', 'data' => $tenant]);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Empresa no encontrada'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al actualizar estado', 'error' => $e->getMessage()], 500);
        }
    }
}
