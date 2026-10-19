<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCurrencyRequest;
use App\Http\Requests\Admin\UpdateCurrencyRequest;
use App\Services\Admin\CurrencyService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Throwable;

class CurrencyController extends Controller
{
    public function __construct(private CurrencyService $service) {}

    public function index(): JsonResponse
    {
        try {
            return response()->json($this->service->getAll());
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al obtener monedas', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            return response()->json($this->service->getById($id));
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Moneda no encontrada'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al obtener moneda', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreCurrencyRequest $request): JsonResponse
    {
        try {
            return response()->json($this->service->create($request->validated()), 201);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al crear moneda', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateCurrencyRequest $request, int $id): JsonResponse
    {
        try {
            return response()->json($this->service->update($id, $request->validated()));
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Moneda no encontrada'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al actualizar moneda', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->service->delete($id);
            return response()->json(['message' => 'Moneda eliminada correctamente']);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Moneda no encontrada'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al eliminar moneda', 'error' => $e->getMessage()], 500);
        }
    }

    public function toggleStatus(int $id): JsonResponse
    {
        try {
            return response()->json($this->service->updateStatus($id));
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Moneda no encontrada'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al actualizar estado', 'error' => $e->getMessage()], 500);
        }
    }

    public function setDefault(int $id): JsonResponse
    {
        try {
            return response()->json($this->service->setDefault($id));
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Moneda no encontrada'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al establecer moneda principal', 'error' => $e->getMessage()], 500);
        }
    }

    public function types(): JsonResponse
    {
        try {
            return response()->json($this->service->types());
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al obtener tipos de moneda', 'error' => $e->getMessage()], 500);
        }
    }
}
