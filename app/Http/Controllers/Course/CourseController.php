<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Lesson;
use App\Models\SubjectMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function getMyCourses(Request $request){
        $user = $request->user();
        $courses = CourseUser::query()
            ->select('courses.*', 'subjects.name as subject_name', 'subjects.subject_image', 'subjects.course_length')
            ->leftJoin('courses', 'courses.id', '=', 'course_users.course_id')
            ->leftJoin('subjects', 'courses.subject_id','=', 'subjects.id')
            ->where('course_users.user_id', '=', $user->id)
            ->get();

        return ['courses'=>$courses];
    }

    public function getCourseLessons(Request $request){
        $course_id = $request->input('course_id');
        $lessons = Lesson::query()
            ->select('lessons.*','lessons.id as lesson_id', 'subject_materials.*', 'home_works.text', 'home_works.image_path')
            ->leftJoin('subject_materials', 'lessons.subject_material_id', '=', 'subject_materials.id')
            ->leftJoin('home_works', 'home_works.id', '=','lessons.homework_id')
            ->where('course_id', '=', $course_id)
            ->orderBy('lessons.date', 'desc')
            ->get();

        return ['lessons' => $lessons];
    }

    public function getLessonsMaterials(Request $request){
        $course = Course::query()->find($request->course_id);
        return [
            'lesson_materials' => SubjectMaterial::query()->where('subject_id', $course->subject_id)->get()
        ];
    }

    public function createLesson(Request $request){
        $data = (object)$request->input();


        try{
            Lesson::query()->create([
                'lesson_number' => $data->lesson_number,
                'lesson_recording' => $data->lesson_record,
                'date' => $data->lesson_date,
                'subject_material_id' => $data->lesson_material,
                'course_id' => $data->course_id,
//                'substitute_teacher_id',
//                'homework_id'
            ]);
        }
        catch (\Exception $e){
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
        return [
            'status' => 'ok',
        ];
    }

    public function dropLesson(Request $request){
        $lesson_id = $request->input('lesson_id');

        Lesson::query()->where('id', $lesson_id)->delete();

        return ['status' => 'ok'];
    }
}
