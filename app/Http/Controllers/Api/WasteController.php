<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WasteCategory;

class WasteController extends Controller
{
    public function index()
    {
        $wasteCategories = WasteCategory::with('children')->where('parent_id', 0)->get();
        return response()->json($wasteCategories);
    }
    public function parent($id)
    {
        $wasteCategories = WasteCategory::with('priceCost')->where('parent_id', $id)->get();
        return response()->json($wasteCategories);
    }

    public function show($id)
    {
        $wasteCategory = WasteCategory::with('priceCost')->find($id);

        if (!$wasteCategory) {
            return response()->json(['message' => 'Waste category not found'], 404);
        }

        return response()->json($wasteCategory);
    }
}

