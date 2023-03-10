<?php

namespace App\Http\Services\Homework;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonDescription;
use App\Models\LessonFiles;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentHomeworkService
{
    const AVAILABLE_EXTENSIONS = ['jpeg', 'png', 'pdf', 'csv', 'jpg', 'zip'];
    const IMAGE_EXTENSIONS = ['jpg', 'jpeg', 'png'];

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
            ->with('files')
            ->where('lesson_id', $lesson_id)
            ->orderBy('created_at')
            ->get()
            ->toArray();

        return $descr;
    }

    public static function createComment(Request $request): array
    {
        try {
            DB::beginTransaction();

            $comment = LessonDescription::create([
                'comment'   => $request->comment ?? '',
                'user_id'   => $request->user()['id'],
                'lesson_id' => $request->lesson_id
            ]);

            if ($request->hasFile('attachments')) {
                $attachments = $request->attachments;
                /** @var UploadedFile $file */
                foreach ($attachments as $file) {
                    $extension = $file->getClientOriginalExtension();
                    if (!in_array($extension, self::AVAILABLE_EXTENSIONS)) {

                        DB::rollBack();

                        return [
                            'status'  => 'error',
                            'message' => 'Не подходящее расширение файла'
                        ];
                    }

                    $fileUrl = self::removeFileExtention($file->store('public/lessons_descriptions'));

                    if ($comment && $fileUrl)
                        LessonFiles::create([
                            'lesson_description_id' => $comment->id,
                            'file_type'             => self::getFileType($extension),
                            'path'                  => 'storage/' . str_replace('public/', '', $fileUrl .  '.' . $extension)
                        ]);
                }
            }

            DB::commit();

            return ['status' => 'ok'];

        } catch (\Exception $e) {

            DB::rollBack();

            return [
                'status'  => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    private static function getRandomFileName(): string
    {
        return Hash::make(time() . time() . time());
    }

    private static function getFileType(string $extension): string
    {
        if (in_array($extension, self::IMAGE_EXTENSIONS))
            return 'image';
        else
            return 'document';
    }

    public static function removeFileExtention(string $fileName): string
    {
        return substr($fileName, 0, strrpos($fileName,'.'));
    }

}
