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
    Route::post('/getCourse', [\App\Http\Controllers\Course\CourseController::class, 'getMyCourses']);
    Route::post('/getInfoForHeader', [\App\Http\Controllers\Header\HeaderController::class, 'index']);
    Route::post('/getLessonsByCourse', [\App\Http\Controllers\Course\CourseController::class, 'getCourseLessons']);
    Route::post('/getLessonsMaterials', [\App\Http\Controllers\Course\CourseController::class, 'getLessonsMaterials']);
    Route::post('/createLesson', [\App\Http\Controllers\Course\CourseController::class, 'createLesson']);
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
    Route::post('lessons/getById', [\App\Http\Controllers\Homework\StudentHomeworkController::class, 'getLessonInfo']);
    Route::post('lessons/getDescription', [\App\Http\Controllers\Homework\StudentHomeworkController::class, 'getHomework']);
    Route::post('lessons/createComment', [\App\Http\Controllers\Homework\StudentHomeworkController::class, 'createComment']);
    Route::post('coursesList', [\App\Http\Controllers\Homework\StudentHomeworkController::class, 'courseList']);
    Route::post('lessonsList', [\App\Http\Controllers\Homework\StudentHomeworkController::class, 'lessonsList']);
    Route::post('studentsList', [\App\Http\Controllers\Homework\StudentHomeworkController::class, 'studentsList']);
});

Route::group(['middleware'=>'auth:sanctum',  'prefix' => '/users'], function (){
    Route::get('getAll', [\App\Http\Controllers\User\UserController::class, 'getUsersForState']);
});

Route::group(['middleware'=>'auth:sanctum',  'prefix' => '/slots'], function (){
    Route::post('/create', [\App\Http\Controllers\TeachersSlots\TeacherSlotsController::class, 'create']);
    Route::post('/edit', [\App\Http\Controllers\TeachersSlots\TeacherSlotsController::class, 'edit']);
    Route::post('/getSlotsForTeacher', [\App\Http\Controllers\TeachersSlots\TeacherSlotsController::class, 'getSlotsForTeacher']);
    Route::post('/getFreeSlots', [\App\Http\Controllers\TeachersSlots\TeacherSlotsController::class, 'getFreeSlots']);
});

