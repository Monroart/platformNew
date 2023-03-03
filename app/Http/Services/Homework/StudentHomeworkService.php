<?php

namespace App\Http\Services\Homework;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonDescription;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;

class StudentHomeworkService
{
    const AVAILABLE_EXTENSIONS = ['jpeg', 'png', 'pdf', 'csv'];

    /**
     * Краткая информация о уроке, для шапки в дз
     * @param int $lesson_id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
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

    /**
     * Ответ ученика и обсуждение с учителем
     * конкретного дз
     * @param int $lesson_id
     * @return array
     */
    public function getDescriptionByLessonId(int $lesson_id): array
    {
        $descr = LessonDescription::query()
            ->where('lesson_id', $lesson_id)
            ->get()
            ->toArray();

        return $descr;
    }

    public static function uploadFile(Request $request)
    {

            try {
                if ($request->hasFile('attachments')) {
                    $attachments = $request->attachments;
                    /** @var UploadedFile $file */
                    foreach ($attachments as $file) {
                        $extension = $file->getClientOriginalExtension();
                        if (!in_array($extension, self::AVAILABLE_EXTENSIONS))
                            return [
                                'status'  => 'error',
                                'message' => 'Не подходящее расширение файла'
                            ];

                        $fileUrl = $file->store('public/lessons_descriptions');
                    }
                }

                LessonDescription::create([
                    'file' => $fileUrl ?? '',
                    'file_type' => 'image',
                    'comment' => $request->comment ?? '',
                    'user_id' => $request->user()['id'],
                    'lesson_id' => $request->lesson_id
                ]);
            } catch (\Exception $e) {
                return [
                    'status'  => 'error',
                    'message' => $e->getMessage()
                ];
            }
            return ['status' => 'ok'];
    }

    private static function getRandomFileName(): string
    {
        return Hash::make(time() . time() . time());
    }

}
