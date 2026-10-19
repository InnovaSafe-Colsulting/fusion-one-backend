<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreProductTypeRequest;
use App\Http\Requests\Products\UpdateProductTypeRequest;
use App\Services\Products\ProductTypeService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Throwable;

class ProductTypeController extends Controller
{
    public function __construct(private ProductTypeService $service) {}

    public function index(): JsonResponse
    {
        try {
            return response()->json($this->service->getAll());
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al obtener tipos de producto', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            return response()->json($this->service->getById($id));
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Tipo de producto no encontrado'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al obtener tipo de producto', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreProductTypeRequest $request): JsonResponse
    {
        try {
            return response()->json($this->service->create($request->validated()), 201);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al crear tipo de producto', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateProductTypeRequest $request, int $id): JsonResponse
    {
        try {
            return response()->json($this->service->update($id, $request->validated()));
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Tipo de producto no encontrado'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al actualizar tipo de producto', 'error' => $e->getMessage()], 500);
        }
    }

    public function toggleStatus(int $id): JsonResponse
    {
        try {
            return response()->json($this->service->updateStatus($id));
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Tipo de producto no encontrado'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al actualizar estado', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->service->delete($id);
            return response()->json(['message' => 'Tipo de producto eliminado correctamente']);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Tipo de producto no encontrado'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al eliminar tipo de producto', 'error' => $e->getMessage()], 500);
        }
    }
}
