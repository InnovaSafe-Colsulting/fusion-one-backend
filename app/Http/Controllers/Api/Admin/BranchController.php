<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBranchRequest;
use App\Http\Requests\Admin\UpdateBranchRequest;
use App\Services\Admin\BranchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class BranchController extends Controller
{
    public function __construct(private BranchService $service) {}

    public function active(): JsonResponse
    {
        return response()->json($this->service->getActive());
    }

    public function index(Request $request): JsonResponse
    {
        try {
            return response()->json($this->service->getAll($request->all()));
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al obtener sucursales', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            return response()->json($this->service->getById($id));
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Sucursal no encontrada'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al obtener sucursal', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreBranchRequest $request): JsonResponse
    {
        try {
            return response()->json($this->service->create($request->validated()), 201);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al crear sucursal', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateBranchRequest $request, int $id): JsonResponse
    {
        try {
            return response()->json($this->service->update($id, $request->validated()));
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Sucursal no encontrada'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al actualizar sucursal', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->service->delete($id);
            return response()->json(['message' => 'Sucursal eliminada correctamente']);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Sucursal no encontrada'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al eliminar sucursal', 'error' => $e->getMessage()], 500);
        }
    }

    public function toggleStatus(int $id): JsonResponse
    {
        try {
            $isActive = (bool) request()->input('is_active');
            $branch = $this->service->toggleStatus($id, $isActive);
            return response()->json(['message' => 'Estado actualizado correctamente', 'data' => $branch]);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Sucursal no encontrada'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al actualizar estado', 'error' => $e->getMessage()], 500);
        }
    }
}