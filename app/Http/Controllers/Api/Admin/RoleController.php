<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use App\Services\Admin\RoleService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class RoleController extends Controller
{
    public function __construct(private RoleService $service) {}

    public function index(Request $request): JsonResponse
    {
        try {
            return response()->json($this->service->getAll($request->all()));
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al obtener roles', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            return response()->json($this->service->getById($id));
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al obtener rol', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreRoleRequest $request): JsonResponse
    {
        try {
            return response()->json($this->service->create($request->validated()), 201);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al crear rol', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateRoleRequest $request, int $id): JsonResponse
    {
        try {
            return response()->json($this->service->update($id, $request->validated()));
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al actualizar rol', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->service->delete($id);
            return response()->json(['message' => 'Rol eliminado correctamente']);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al eliminar rol', 'error' => $e->getMessage()], 500);
        }
    }

    public function toggleStatus(int $id): JsonResponse
    {
        try {
            $isActive = (bool) request()->input('is_active');
            $role = $this->service->toggleStatus($id, $isActive);
            return response()->json(['message' => 'Estado actualizado correctamente', 'data' => $role]);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al actualizar estado', 'error' => $e->getMessage()], 500);
        }
    }

    public function active(): JsonResponse
    {
        try {
            return response()->json($this->service->getActive());
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al obtener roles activos', 'error' => $e->getMessage()], 500);
        }
    }
}