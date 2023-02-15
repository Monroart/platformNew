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

});

Route::group(['middleware'=>'auth:sanctum',  'prefix' => '/courses'], function (){
    Route::post('/getCourse', [\App\Http\Controllers\Course\CourseCountroller::class, 'getMyCourses']);
    Route::post('/getInfoForHeader', [\App\Http\Controllers\Header\HeaderController::class, 'index']);
    Route::post('/getLessonsByCourse', [\App\Http\Controllers\Course\CourseCountroller::class, 'getCourseLessons']);
});


Route::group(['middleware'=>'auth:sanctum',  'prefix' => '/profile'], function (){
    Route::post('/getInfoForHeader', [\App\Http\Controllers\Header\HeaderController::class, 'index']);
    Route::post('/getImage', [\App\Http\Controllers\Profile\ProfileController::class, 'getImage']); //подгрузка фото при открытии траницы
    Route::post('/uploadImage', [\App\Http\Controllers\Profile\ProfileController::class, 'changeImage']); //загрузка фото
    Route::post('/deleteImage', [\App\Http\Controllers\Profile\ProfileController::class, 'deleteImage']); //удаление фотки, привязать на маленький крестик
    Route::post('/saveInfo', [\App\Http\Controllers\Profile\ProfileController::class, 'saveInfo']); //сохранение результатов изменения данных в профиле, привязать к кнопке сохранить мзменения
    Route::post('/getProfile', [\App\Http\Controllers\Profile\ProfileController::class, 'getInfoProfile']); //подгрузка всех полей профиля
});

Route::group(['middleware'=>'auth:sanctum',  'prefix' => '/homeworks'], function (){
    Route::post('getLessonInfo', [\App\Http\Controllers\Homework\StudentHomeworkController::class, 'getLessonInfo']);
    Route::post('getStudentHomework', [\App\Http\Controllers\Homework\StudentHomeworkController::class]);
});

Route::group(['middleware'=>'auth:sanctum',  'prefix' => '/users'], function (){
    Route::get('getAll', [\App\Http\Controllers\User\UserController::class, 'getUsersForState']);
});

