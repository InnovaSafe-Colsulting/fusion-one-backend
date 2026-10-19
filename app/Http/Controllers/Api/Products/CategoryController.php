<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreCategoryRequest;
use App\Http\Requests\Products\UpdateCategoryRequest;
use App\Services\Products\CategoryService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Throwable;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $service) {}

    public function active(): JsonResponse
    {
        try {
            return response()->json($this->service->getActive());
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al obtener categorías activas', 'error' => $e->getMessage()], 500);
        }
    }

    public function index(): JsonResponse
    {
        try {
            return response()->json($this->service->getAll());
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al obtener categorías', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            return response()->json($this->service->getById($id));
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al obtener categoría', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreCategoryRequest $request): JsonResponse
    {
        try {
            return response()->json($this->service->create($request->validated()), 201);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al crear categoría', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateCategoryRequest $request, int $id): JsonResponse
    {
        try {
            return response()->json($this->service->update($id, $request->validated()));
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al actualizar categoría', 'error' => $e->getMessage()], 500);
        }
    }

    public function toggleStatus(int $id): JsonResponse
    {
        try {
            return response()->json($this->service->updateStatus($id));
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al actualizar estado', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->service->delete($id);
            return response()->json(['message' => 'Categoría eliminada correctamente']);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al eliminar categoría', 'error' => $e->getMessage()], 500);
        }
    }
}
