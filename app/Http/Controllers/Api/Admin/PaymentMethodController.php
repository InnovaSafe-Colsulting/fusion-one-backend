<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePaymentMethodRequest;
use App\Http\Requests\Admin\UpdatePaymentMethodRequest;
use App\Services\Admin\PaymentMethodService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class PaymentMethodController extends Controller
{
    public function __construct(private PaymentMethodService $service) {}

    public function index(Request $request): JsonResponse
    {
        try {
            return response()->json($this->service->getAll($request->all()));
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al obtener métodos de pago', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            return response()->json($this->service->getById($id));
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Método de pago no encontrado'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al obtener método de pago', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(StorePaymentMethodRequest $request): JsonResponse
    {
        try {
            return response()->json($this->service->create($request->validated()), 201);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al crear método de pago', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdatePaymentMethodRequest $request, int $id): JsonResponse
    {
        try {
            return response()->json($this->service->update($id, $request->validated()));
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Método de pago no encontrado'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al actualizar método de pago', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->service->delete($id);
            return response()->json(['message' => 'Método de pago eliminado correctamente']);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Método de pago no encontrado'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al eliminar método de pago', 'error' => $e->getMessage()], 500);
        }
    }

    public function toggleStatus(int $id): JsonResponse
    {
        try {
            $isActive = (bool) request()->input('is_active');
            $method = $this->service->toggleStatus($id, $isActive);
            return response()->json(['message' => 'Estado actualizado correctamente', 'data' => $method]);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Método de pago no encontrado'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al actualizar estado', 'error' => $e->getMessage()], 500);
        }
    }

    public function active(): JsonResponse
    {
        try {
            return response()->json($this->service->getActive());
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al obtener métodos de pago activos', 'error' => $e->getMessage()], 500);
        }
    }

    public function types(): JsonResponse
    {
        return response()->json($this->service->getTypes());
    }
}