<?php

namespace App\Http\Controllers\Homework;
use App\Http\Controllers\Controller;
use App\Http\Services\Homework\StudentHomeworkService;
use Illuminate\Http\Request;

class StudentHomeworkController extends Controller
{
    public function getLessonInfo(Request $request, StudentHomeworkService $service)
    {
        return $service->getLessonInfo($request->input('lesson_id'));
    }

    public function getHomework(Request $request)
    {

    }
}
