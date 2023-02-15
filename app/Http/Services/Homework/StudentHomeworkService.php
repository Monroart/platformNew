<?php

namespace App\Http\Services\Homework;

use App\Models\Course;
use App\Models\Lesson;

class StudentHomeworkService
{
    private $user_id;
    public function __construct(int $user_id)
    {
        $this->user_id = $user_id;
    }

    public function getLessonInfo(int $lesson_id)
    {
        try {
            return [
                'status' => 'ok',
                'lesson' => Lesson::find($lesson_id)
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'ok',
                'message' => $e->getMessage()
            ];
        }

    }

    public function getHomework(int $lesson_id)
    {
        try {
            return [
                'status' => 'ok',
                'lesson' => Lesson::find($lesson_id)
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'ok',
                'message' => $e->getMessage()
            ];
        }

    }

}
