<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePermissionRequest;
use App\Http\Requests\Admin\UpdatePermissionRequest;
use App\Services\Admin\PermissionService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class PermissionController extends Controller
{
    public function __construct(private PermissionService $service) {}

    public function index(Request $request): JsonResponse
    {
        try {
            return response()->json($this->service->getAll($request->all()));
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al obtener permisos', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            return response()->json($this->service->getById($id));
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Permiso no encontrado'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al obtener permiso', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(StorePermissionRequest $request): JsonResponse
    {
        try {
            return response()->json($this->service->create($request->validated()), 201);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al crear permiso', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdatePermissionRequest $request, int $id): JsonResponse
    {
        try {
            return response()->json($this->service->update($id, $request->validated()));
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Permiso no encontrado'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al actualizar permiso', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->service->delete($id);
            return response()->json(['message' => 'Permiso eliminado correctamente']);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Permiso no encontrado'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al eliminar permiso', 'error' => $e->getMessage()], 500);
        }
    }

    public function toggleStatus(int $id): JsonResponse
    {
        try {
            $isActive = (bool) request()->input('is_active');
            $permission = $this->service->toggleStatus($id, $isActive);
            return response()->json(['message' => 'Estado actualizado correctamente', 'data' => $permission]);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Permiso no encontrado'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al actualizar estado', 'error' => $e->getMessage()], 500);
        }
    }
}