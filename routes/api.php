<?php

use App\Http\Controllers\API\ChatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/get-chat-list', [ChatController::class , 'index']);

Route::get('/get-user-messages', [ChatController::class , 'show']);

Route::post('/send-messages', [ChatController::class , 'send-messages']);

