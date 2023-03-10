<?php

namespace App\Http\Services\Homework;

use App\Http\Services\Traits\ErrorReturnTrait;
use App\Models\CourseUser;
use App\Models\Lesson;
use Illuminate\Support\Facades\DB;

class HomeworkService
{
    private $user_id;

    const TEACHER_ROLE = 'teacher';
    const STUDENT_ROLE = 'student';

    use ErrorReturnTrait;

    /**
     * Список курсов для раздела ДЗ
     * @param string $role
     * @return array
     */
    public function getCourseList(string $role): array
    {
        try {
            switch ($role) {
                case self::STUDENT_ROLE:
                    $courses = $this->courseListForStudent();
                    break;
                case self::TEACHER_ROLE:
                    $courses = $this->courseListForteacher();
                    break;
                default:
                    return $this->returnError('Не известная роль');
            }
            return [
                'status'  => 'ok',
                'courses' => $courses
            ];
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    public function setUserId(int $id): void
    {
        $this->user_id = $id;
    }

    public function getLessonsByCourseId($course_id): array
    {
        try {
            $lessons = Lesson::query()
                ->where('course_id', $course_id)
                ->with('lesson_description')
                ->orderBy('date')
                ->get();

            return [
                'status' => 'ok',
                'lessons' => $lessons
            ];
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    private function courseListForStudent()
    {
        $selected_columns = ['c.id', 'c.start_date', 'c.name', 'cu.completed', 's.subject_image'];

        $courses = CourseUser::query()
            ->from('course_users AS cu')
            ->leftJoin('courses AS c', 'cu.course_id', '=', 'c.id')
            ->leftJoin('lessons AS l', 'l.course_id', '=', 'c.id')
            ->leftJoin('subjects AS s', 'c.subject_id', '=', 's.id')
            ->where('cu.user_id', $this->user_id)
            ->select($selected_columns)
            ->addSelect(DB::raw('COUNT(l.id) AS count_lessons'))
            ->addSelect(DB::raw('COUNT(l.id) filter (where l.date <= now()) AS count_lessons_complete'))
            ->distinct('c.id')
            ->groupBy($selected_columns)
            ->get();

        return $courses;
    }

    private function courseListForteacher()
    {
        return [];
    }
}
