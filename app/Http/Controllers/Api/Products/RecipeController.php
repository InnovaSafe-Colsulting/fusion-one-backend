<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreRecipeRequest;
use App\Http\Requests\Products\UpdateRecipeRequest;
use App\Services\Products\RecipeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class RecipeController extends Controller
{
    public function __construct(private RecipeService $service) {}

    public function index(Request $request): JsonResponse
    {
        return response()->json($this->service->getAll($request->all()));
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->service->getById($id));
    }

    public function store(StoreRecipeRequest $request): JsonResponse
    {
        try {
            return response()->json($this->service->create($request->validated()), 201);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateRecipeRequest $request, int $id): JsonResponse
    {
        try {
            return response()->json($this->service->update($id, $request->validated()));
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function toggleStatus(int $id): JsonResponse
    {
        try {
            return response()->json($this->service->updateStatus($id));
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->service->delete($id);
            return response()->json(null, 204);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
