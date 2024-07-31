<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\APIsController;

class MainController extends Controller
{
    public function getToken(Request $request)
    {
        try {
            $user = auth()->user();
            $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;
    
            $apiController = new APIsController();
            $apiResponse = $apiController->insert($token);

            if ($apiResponse->status() == 201) {
                $responseData = $apiResponse->getData(true); 
                $apiId = $responseData['api_id'] ?? null;
                return response()->json([
                    'access_token' => $token,
                    'message' => 'Token generated and API key inserted successfully',
                    'id' =>  $apiId
                ], 201);
            } else {
                return response()->json([
                    'message' => 'API generated but failed to insert'
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Exceptional Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
}


