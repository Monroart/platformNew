<?php

namespace App\Http\Controllers\LessonVisits;

use App\Http\Controllers\Controller;
use App\Models\CourseUser;
use App\Models\Lesson;
use App\Models\LessonVisit;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LessonVisitsController extends Controller
{
    public function getLessonVisits(Request $request){
        $lesson_id = $request->input('lesson_id');
        $visits = LessonVisit::query()
            ->where('lesson_id', $lesson_id)
            ->pluck('user_id')
            ->toArray();

        return [
            'status' => 'ok',
            'visits' => $visits
        ];
    }
    public function changeLessonVisits(Request $request)
    {
        $lesson_id = $request->input('visits')['lesson_id'];
        $user_ids = $request->input('visits')['users'];

        $visits = LessonVisit::query()->where('lesson_id', $lesson_id)->pluck('user_id')->toArray();

        if (count($user_ids) > count($visits)) {
            $diff = array_diff($user_ids, $visits);
            foreach ($diff as $user_id) {
                LessonVisit::query()->create([
                    'lesson_id' => $lesson_id,
                    'user_id' => $user_id
                ]);
            }
        }
        elseif (count($user_ids) < count($visits)) {
            $diff = array_diff($visits,$user_ids);
            foreach ($diff as $user_id) {
                LessonVisit::query()
                    ->where('lesson_id', $lesson_id)
                    ->where('user_id', $user_id)
                    ->delete();
            }
        }
        else{
            return [
                'status' => 'ok',
                'message' => 'Ничего не изменилось'
            ];
        }
        return [
            'status' => 'ok',
        ];
    }
}
