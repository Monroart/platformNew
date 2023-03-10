<?php

namespace App\Http\Services\Homework;

use App\Http\Services\Traits\ErrorReturnTrait;
use App\Models\CourseUser;
use App\Models\Lesson;
use App\Models\LessonDescription;
use Carbon\Carbon;
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
                    $courses = $this->courseListForTeacher();
                    break;
                default:
                    return $this->returnError('Не известная роль');
            }

            return ['status' => 'ok', 'courses' => $courses];

        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    /**
     * Список студентов для проверки дз
     * @param int $lesson_id
     * @param int $teacher_id
     * @return array
     */
    public function getStudentList(int $lesson_id, int $teacher_id): array
    {
        $selected_columns = ['user_id', 'lesson_id'];

        try {
            $students = LessonDescription::query()
                ->where('lesson_id', $lesson_id)
                ->select($selected_columns)
                ->addSelect(DB::raw('COUNT(id) AS count_comments'))
                ->groupBy($selected_columns)
                ->get()
                ->toArray();

            $students = array_filter($students, function ($item) use ($teacher_id) {
               if ($item['user_id'] !== $teacher_id)
                   return $item;
            });

            return ['status' => 'ok', 'students' => $students];

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

            return ['status' => 'ok', 'lessons' => $lessons];

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

    /**
     * Сразу список уроков на проверку
     */
    private function courseListForTeacher(): object
    {
        $lessonsIds = Lesson::query()
            ->leftJoin('courses AS c', 'lessons.course_id', '=', 'c.id')
            ->where(function ($q) {
                $q->where('c.default_teacher_id', $this->user_id)
                    ->orWhere('lessons.substitute_teacher_id', $this->user_id);
            })->pluck('lessons.id');

        $comments = LessonDescription::query()
            ->from('lesson_descriptions AS ld')
            ->leftJoin('lessons AS l', 'l.id', 'ld.lesson_id')
            ->leftJoin('courses AS c', 'l.course_id', '=', 'c.id')
            ->whereIn('l.id', $lessonsIds)
            ->select('c.name', 'l.lesson_number', 'ld.created_at', 'l.id', 'ld.user_id', 'c.id AS course_id', 'l.date')
            ->get();

        $lessons = [];

        $coursesIds = collect($comments)->pluck('course_id')->toArray();
        $students = CourseUser::whereIn('course_id', $coursesIds)->distinct('user_id')->get();

        foreach ($lessonsIds as $lesson_id) {
            $lastComment = collect($comments)
                ->where('id', $lesson_id)
                ->sortByDesc('created_at')
                ->first();

            if ($lastComment->user_id === $this->user_id)
                continue;

            $lastComment->created_at = Carbon::parse($lastComment->created_at)->setTimezone('Europe/Moscow');

            $lastComment->count_students = collect($students)->where('course_id', $lastComment->course_id)->count();

            $lessons[] = $lastComment;
        }

        return collect($lessons)->sortByDesc('created_at')->values();
    }
}
