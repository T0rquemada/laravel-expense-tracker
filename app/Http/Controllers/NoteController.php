<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller {
    private function insert(String $table, $data) {
        DB::table($table)->insert([
            'user_id' => $data['user_id'],
            'amount' => $data['amount'],
            'category_id' => $data['category_id'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function create(Request $req) {
        try {
            $validated_data = $req->validate([
                'user_id' => 'required',
                'amount' => 'required',
                'category_id' => 'required',
                'type' => 'required'
            ]);

            $this->insert($validated_data['type'], $validated_data);
            return response()->json(['message' => 'Note created succesfully!']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Validation error: ' . $e->getMessage()], 422);
        } catch (\Exception $e) {
            error_log($e);
            return response()->json(['message' => 'Server error: ' . $e->getMessage()], 500);
        }
    }
    
}