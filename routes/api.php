<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\formController;
// Route::group(['middleware'=>'api'],function($routes){
    // Route::get('/form',[formController::class,'form_page']);
    Route::post('/submit',[formController::class,'submit_page']);
    Route::get('/getall',[formController::class,'fetch_data']);
    // Route::get('/edit{id}',[formController::class,'edit_data']);
    Route::put('/update/{id}',[formController::class,'update_page']);
    Route::delete('/delete/{id}',[formController::class,'delete_data']);
    Route::get('/foods/{lim1}/{lim2}',[formController::class,'search_food']);
// });
// Route::get('/signup',[formController::class,'signup_page']);
Route::post('/fsubmit',[formController::class,'form_submit_page']);
// Route::get('/login',[formController::class,'login_page']);
Route::post('/login_submit',[formController::class,'login_data']);
Route::post('/newfood',[formController::class,'new_food_data']);
// Route::get('/logout',[formController::class,'logout_page']);
// Route::post('/newfood',[formController::class,'fooddata']);
