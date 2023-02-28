<?php

namespace App\Http\Services\Homework;

use App\Models\Course;
use App\Models\Lesson;

class StudentHomeworkService
{
    public function getLessonInfo(int $lesson_id)
    {
        $lesson = Lesson::query()->from('lessons AS l')
            ->leftJoin('courses AS c', 'l.course_id', '=', 'c.id')
            ->leftJoin('users AS u', 'l.substitute_teacher_id', '=', 'u.id')
            ->leftJoin('subject_materials AS sm', 'l.subject_material_id', '=', 'sm.id')
            ->leftJoin('home_works AS hw', 'l.homework_id', '=', 'hw.id')
            ->where('l.id', $lesson_id)
            ->select('l.lesson_number', 'l.date', 'sm.name AS theme', 'c.name AS course_name',
                'u.name AS teacher', 'hw.text', 'hw.image_path'
            )
            ->first();

        return $lesson;
    }

    public function getHomework(int $lesson_id)
    {

    }

}
