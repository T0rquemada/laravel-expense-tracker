<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller {

    public function create(Request $req) {
        try {
            $validated_data = $req->validate([
                'title' => 'required|string',
                'user_id' =>'required'
            ]);

            Category::create($validated_data);
            return response()->json(['message' => 'Note created succesfully!']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Validation error: ' . $e->getMessage()], 422);
        } catch (\Exception $e) {
            error_log($e);
            return response()->json(['message' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

    public function get_all() {

    }
}