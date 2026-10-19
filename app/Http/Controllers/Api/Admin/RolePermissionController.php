<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRolePermissionRequest;
use App\Http\Requests\Admin\UpdateRolePermissionRequest;
use App\Services\Admin\RolePermissionService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class RolePermissionController extends Controller
{
    public function __construct(private RolePermissionService $service) {}

    public function index(Request $request): JsonResponse
    {
        try {
            $roleId   = $request->query('role_id');
            $moduleId = $request->query('module_id');
            return response()->json($this->service->getByRoleAndModule($roleId, $moduleId));
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al obtener permisos', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreRolePermissionRequest $request): JsonResponse
    {
        try {
            return response()->json($this->service->create($request->validated()), 201);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al asignar permiso', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateRolePermissionRequest $request, int $id): JsonResponse
    {
        try {
            return response()->json($this->service->update($id, $request->validated()));
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Permiso de rol no encontrado'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al actualizar permiso de rol', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->service->delete($id);
            return response()->json(['message' => 'Permiso de rol eliminado correctamente']);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Permiso de rol no encontrado'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al eliminar permiso de rol', 'error' => $e->getMessage()], 500);
        }
    }
}
