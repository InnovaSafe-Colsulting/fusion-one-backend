<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePaymentMethodConfigRequest;
use App\Http\Requests\Admin\UpdatePaymentMethodConfigRequest;
use App\Services\Admin\PaymentMethodConfigService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class PaymentMethodConfigController extends Controller
{
    public function __construct(private PaymentMethodConfigService $service) {}

    public function index(Request $request): JsonResponse
    {
        try {
            $paymentMethodId = (int) $request->query('payment_method_id');

            if (! $paymentMethodId) {
                return response()->json(['message' => 'payment_method_id es requerido'], 422);
            }

            return response()->json($this->service->getByPaymentMethod($paymentMethodId));
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al obtener configuraciones', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(StorePaymentMethodConfigRequest $request): JsonResponse
    {
        try {
            return response()->json($this->service->create($request->validated()), 201);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al crear configuración', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdatePaymentMethodConfigRequest $request, int $id): JsonResponse
    {
        try {
            return response()->json($this->service->update($id, $request->validated()));
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Configuración no encontrada'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al actualizar configuración', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->service->delete($id);
            return response()->json(['message' => 'Configuración eliminada correctamente']);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Configuración no encontrada'], 404);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error al eliminar configuración', 'error' => $e->getMessage()], 500);
        }
    }
}
