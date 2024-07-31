<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\APIs;

class APIsController extends Controller
{
    public function insert($api)
    {
        try {
            $apiRecord = APIs::create([
                'user_id' => auth()->id(),
                'api_key' => $api
            ]);
    
            return response()->json([
                'message' => 'API key inserted successfully',
                'api_id' => $apiRecord->id
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error inserting API key',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    

    public function delete(Request $request)
    {
        $validatedData = $request->validate([
            'api_id' => 'required'
        ]);

        $apiId = $validatedData['api_id'];

        $apiRecord = APIs::where('user_id', auth()->id())
                         ->where('id', $apiId)
                         ->first();

        if ($apiRecord) {
            $apiRecord->delete();
            return response()->json([
                'message' => 'API key deleted successfully'
            ], 200);
        }

        return response()->json([
            'message' => 'API key not found'
        ], 404);
    }
    public function getAllApis()
    {
        $apis = APIs::where('user_id', auth()->id())->get();

        return response()->json([
            'message' => 'API keys retrieved successfully',
            'data' => $apis
        ], 200);
    }

}
