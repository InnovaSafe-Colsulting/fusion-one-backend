<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Services\Admin\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{
    public function __construct(private UserService $service) {}

    public function index(Request $request): JsonResponse
    {
        try {
            return response()->json($this->service->getAll($request->all()));
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al obtener usuarios', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            return response()->json($this->service->getById($id));
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al obtener usuario', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $roleId = $data['role_id'];
            unset($data['role_id']);

            $user = $this->service->create($data);
            $user->roles()->sync([$roleId]);

            return response()->json($user->load('roles:id,name,slug'), 201);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al crear usuario', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        try {
            $data = $request->validated();
            $roleId = $data['role_id'];
            unset($data['role_id']);

            if (empty($data['password'])) {
                unset($data['password']);
            }

            $user = $this->service->update($id, $data);
            $user->roles()->sync([$roleId]);

            return response()->json($user->load('roles:id,name,slug'));
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al actualizar usuario', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $user = $this->service->getById($id);
            $user->roles()->detach();
            $this->service->delete($id);
            return response()->json(['message' => 'Usuario eliminado correctamente']);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al eliminar usuario', 'error' => $e->getMessage()], 500);
        }
    }

    public function toggleStatus(int $id): JsonResponse
    {
        try {
            $isActive = (bool) request()->input('is_active');
            $user = $this->service->toggleStatus($id, $isActive);
            return response()->json(['message' => 'Estado actualizado correctamente', 'data' => $user]);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al actualizar estado', 'error' => $e->getMessage()], 500);
        }
    }
}