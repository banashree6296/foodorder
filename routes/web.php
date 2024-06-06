<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Use App\Http\Controllers\formController;
Route::get('/', function () {
    return view('welcome');
});

// Route::get('/form',[formController::class,'form_page']);
// Route::post('/submit',[formController::class,'submit_page']);
// Route::get('/getall',[formController::class,'fetch_data']);
// Route::get('/edit{id}',[formController::class,'edit_data']);
// Route::post('/update',[formController::class,'update_page']);
// Route::get('/delete{id}',[formController::class,'delete_data']);
// Route::get('/signup',[formController::class,'signup_page']);
// Route::post('/signup_submit',[formController::class,'signup_data']);
