<?php

use App\Http\Controllers\APIAuthController;
use App\Http\Controllers\APIsController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MessageController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/addMessage', function () {
        return Inertia::render('AddMessage');
    })->name('AddMessage');
    
    Route::get('/allMessages', function () {
        return Inertia::render('AllMessages');
    })->name('AllMessages');

    Route::get('/sentMessages', function () {
        return Inertia::render('SentMessages');
    })->name('SentMessages');

    Route::get('/scheduledMessages', function () {
        return Inertia::render('ScheduledMessages');
    })->name('scheduledMessages');
    

    Route::get('/failedMessages', function () {
        return Inertia::render('FailedMessages');
    })->name('FailedMessages');

    Route::get('/pendingMessages', function () {
        return Inertia::render('PendingMessages');
    })->name('PendingMessages');


    Route::get('/myConnection', function () {
        return Inertia::render('MyConnection');
    })->name('MyConnection');

    Route::get('/APIs', function () {
        return Inertia::render('APIs');
    })->name('APIs');

    Route::get('/stats', function () {
        return Inertia::render('Stats');
    })->name('Stats');

    Route::post('/getToken', [MainController::class, 'getToken'])->name('getToken');

    Route::post('/deleteApi', [APIsController::class, 'delete'])->name('deleteApi');

    Route::post('/getApis', [APIsController::class, 'getAllApis'])->name('getApis');


});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->prefix('webapi')->group(function () {

    Route::post('/addMessage', [MessageController::class, 'addMessage']);
    Route::post('/updatemMessage/{id}', [MessageController::class, 'updateMessage']);
    Route::post('/deleteMessage/{id}', [MessageController::class, 'deleteMessage']);
    Route::get('/getAllMessages', [MessageController::class, 'getAllMessages']);
    Route::post('/getMessageById/{id}', [MessageController::class, 'getMessageById']);
    Route::get('/getMessagesByStatus/{status}', [MessageController::class, 'getMessagesByStatus']);
    Route::post('/getMessageCountsByApiKey', [MessageController::class, 'getMessageCountsByApiKey']);

});

// Route::get('/{path?}', function($path = null){         return Inertia::render('Welcome');     })->where('path', '.*'); 
Route::get('/{path?}', function($path = null){                     return abort(404);
})->where('path', '.*'); 

