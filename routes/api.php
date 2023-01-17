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

Route::middleware('auth:sanctum')->get('/user', [\App\Http\Controllers\User\UserController::class, 'getUser']);

Route::group(['prefix' => '/test'], function (){
    Route::post('/getCourse', [\App\Http\Controllers\Course\CourseCountroller::class, 'getMyCourses']);
});

Route::group(['middleware'=>'auth:sanctum',  'prefix' => '/courses'], function (){
    //
});

Route::group(['middleware'=>'auth:sanctum',  'prefix' => '/profile'], function (){
    //TODO
});

Route::group(['middleware'=>'auth:sanctum',  'prefix' => '/homeworks'], function (){
    //
});

