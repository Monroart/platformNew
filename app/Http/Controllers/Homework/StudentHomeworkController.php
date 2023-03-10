<?php

namespace App\Http\Controllers\Homework;
use App\Http\Controllers\Controller;
use App\Http\Services\Homework\HomeworkService;
use App\Http\Services\Homework\StudentHomeworkService;
use Illuminate\Http\Request;

class StudentHomeworkController extends Controller
{
    public function getLessonInfo(Request $request, StudentHomeworkService $service)
    {
        return $service->getLessonInfo($request->lesson_id);
    }

    public function getHomework(Request $request, StudentHomeworkService $service): array
    {
        return $service->getDescriptionByLessonId($request->lesson_id);
    }

    public function createComment(Request $request): array
    {
        return StudentHomeworkService::createComment($request);
    }

    public function courseList(Request $request, HomeworkService $service): array
    {
        $service->setUserId($request->user()['id']);

        return $service->getCourseList($request->role);
    }

    public function lessonsList(Request $request, HomeworkService $service): array
    {
        return $service->getLessonsByCourseId($request->course_id);
    }

    public function studentsList(Request $request, HomeworkService $service): array
    {
        return $service->getStudentList($request->lesson_id, $request->user()['id']);
    }
}
