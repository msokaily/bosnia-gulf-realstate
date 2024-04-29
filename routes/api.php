<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');
// header('Access-Control-Allow-Credentials: true');
// header('Access-Control-Allow-Headers: Authorization, Content-Type');

if(request('lang') != Null){
    $lang = request('lang');
    \App::setlocale($lang); 
}


Route::get('menu-items', [ApiController::class, 'index']);