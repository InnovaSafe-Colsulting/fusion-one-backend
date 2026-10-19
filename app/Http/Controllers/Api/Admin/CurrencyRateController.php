<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCurrencyRateRequest;
use App\Services\Admin\CurrencyRateService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Throwable;

class CurrencyRateController extends Controller
{
    public function __construct(private CurrencyRateService $service) {}

    public function index(): JsonResponse
    {
        try {
            return response()->json($this->service->getAll());
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al obtener tasas', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreCurrencyRateRequest $request): JsonResponse
    {
        try {
            return response()->json($this->service->create($request->validated()), 201);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al crear tasa', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->service->delete($id);
            return response()->json(['message' => 'Tasa eliminada correctamente']);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Tasa no encontrada'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al eliminar tasa', 'error' => $e->getMessage()], 500);
        }
    }
}
