<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIAuthController;
use App\Http\Controllers\MessageController;


Route::post('register',[APIAuthController::class,'register']);
Route::post('login',[APIAuthController::class,'login']);
Route::post('logout',[APIAuthController::class,'logout'])
  ->middleware('auth:sanctum');

  Route::middleware('auth:sanctum')->group(function () {
    
    // Add Message
    Route::post('/addMessage', [MessageController::class, 'addMessage']);

    // Update Message
    Route::post('/updatemMessage/{id}', [MessageController::class, 'updateMessage']);

    // Delete Message
    Route::post('/deleteMessage/{id}', [MessageController::class, 'deleteMessage']);

    // Get All Messages
    Route::post('/getAllMessages', [MessageController::class, 'getAllMessages']);

    // Get Message by ID
    Route::post('/getMessageById/{id}', [MessageController::class, 'getMessageById']);

    // Get Messages by Status
    Route::post('/getMessagesByStatus/{status}', [MessageController::class, 'getMessagesByStatus']);

    // Get Message Counts by API Key
    Route::post('/getMessageCountsByApiKey', [MessageController::class, 'getMessageCountsByApiKey']);

  });