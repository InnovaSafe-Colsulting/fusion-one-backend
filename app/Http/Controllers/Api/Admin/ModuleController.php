<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\JsonResponse;

class ModuleController extends Controller
{
    public function menu(): JsonResponse
    {
        $modules = Module::whereNull('parent_id')
            ->where('is_active', true)
            ->with('children')
            ->get();

        return response()->json($modules);
    }

    public function root(): JsonResponse
    {
        $modules = Module::whereNull('parent_id')
            ->whereNull('sub_parent_id')
            ->whereNull('sub_identifier')
            ->where('is_active', true)
            ->select('id', 'name', 'slug')
            ->orderBy('name')
            ->get();

        return response()->json($modules);
    }
}
