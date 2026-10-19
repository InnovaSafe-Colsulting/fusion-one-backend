<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreModifierRequest;
use App\Http\Requests\Products\UpdateModifierRequest;
use App\Services\Products\ModifierService;
use Illuminate\Http\JsonResponse;

class ModifierController extends Controller
{
    public function __construct(private ModifierService $service) {}

    public function index(): JsonResponse
    {
        return response()->json($this->service->getAll(request()->all()));
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->service->getById($id));
    }

    public function store(StoreModifierRequest $request): JsonResponse
    {
        return response()->json($this->service->create($request->validated()), 201);
    }

    public function update(UpdateModifierRequest $request, int $id): JsonResponse
    {
        return response()->json($this->service->update($id, $request->validated()));
    }

    public function toggleStatus(int $id): JsonResponse
    {
        return response()->json($this->service->updateStatus($id));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}
