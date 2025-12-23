<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\ReplyController;
use App\Http\Controllers\Api\Admin\TicketAdminController;




Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return response()->json([
        'success' => true,
        'user' => $request->user()
    ]);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/tickets', [TicketController::class, 'store']);
    Route::get('/tickets', [TicketController::class, 'myTickets']);
    Route::put('/tickets/{id}', [TicketController::class, 'update']);
    Route::put('/tickets/{id}/close', [TicketController::class, 'close']);
    Route::post('/tickets/{id}/replies', [ReplyController::class, 'store']);
    Route::get('/tickets/{id}/replies', [ReplyController::class, 'list']);
    Route::get('/admin/tickets', [TicketAdminController::class, 'index']);
    Route::put('/admin/tickets/{id}/status', [TicketAdminController::class, 'updateStatus']);


});


