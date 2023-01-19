<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\CourseUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseCountroller extends Controller
{
    public function getMyCourses(Request $request){
        $user = $request->user();
        $courses = CourseUser::query()
            ->select('courses.*', 'subjects.name as subject_name', 'subjects.subject_image')
            ->leftJoin('courses', 'courses.id', '=', 'course_users.course_id')
            ->leftJoin('subjects', 'courses.subject_id','=', 'subjects.id')
            ->where('course_users.user_id', '=', $user->id)
            ->get();

        return ['courses'=>$courses];
    }
}
