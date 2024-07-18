<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/list_tasks', [TaskController::class, 'all_tasks']);
Route::post('/add_task', [TaskController::class, 'create_task']);
Route::put('/update_task/{id}', [TaskController::class, 'update_task']);
Route::delete('/delete_task/{id}', [TaskController::class, 'delete_task']);
Route::get('/list_priority_levels', [TaskController::class, 'priority_levels']); 
