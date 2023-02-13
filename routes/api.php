<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getallfamilly', [ApiController::class, 'getallfamilly']);
Route::get('/getallchild', [ApiController::class, 'getallchild']);
Route::get('/getallgrandchild', [ApiController::class, 'getallgrandchild']);

Route::post('/create/familly', [ApiController::class, 'familly']);
Route::post('/create/child', [ApiController::class, 'child']);
Route::post('/create/grandchild', [ApiController::class, 'grandchild']);

Route::put('/update/familly', [ApiController::class, 'update_familly']);
Route::put('/update/child', [ApiController::class, 'update_child']);
Route::put('/update/grandchild', [ApiController::class, 'update_grandchild']);

Route::delete('/delete/familly', [ApiController::class, 'delete_familly']);
Route::delete('/delete/child', [ApiController::class, 'delete_child']);
Route::delete('/delete/grandchild', [ApiController::class, 'delete_grandchild']);
