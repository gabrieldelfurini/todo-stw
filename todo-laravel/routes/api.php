<?php

use App\Http\Controllers\TodosController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/todos', [TodosController::class, 'index']);
Route::post('/todos', [TodosController::class, 'store']);
Route::patch('/todos/{todo}', [TodosController::class, 'update']);
Route::delete('/todos/{todo}', [TodosController::class, 'destroy']);