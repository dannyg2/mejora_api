<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\Api\HistoriaController;
use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\Api\NutricionistaController;


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

Route::get('/test', function(){ dd("hola"); });
Route::post('register', 'App\Http\Controllers\UserController@register');
Route::post('login', 'App\Http\Controllers\UserController@authenticate');
Route::group(['middleware' => ['jwt.verify']], function() {
   
    
});
Route::post("facturas", [FacturaController::class, 'store']); 
Route::get("facturas/{factura}", [FacturaController::class, 'byId']); 
Route::get("facturas", [FacturaController::class, 'all']); 