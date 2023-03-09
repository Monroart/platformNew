<?php

namespace App\Http\Services\User;

use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Lesson;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    /** @var User $user - текущий пользователь */
    private $user;

    const CONNECIONS_FIELDS = ['u.name', 'u.role_id', 'u.phone', 'p.profile_image',
        'p.about', 'p.age', 'u.id', 'cu.course_id'];

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Получить всех пользователей, связанных с текущим
     */
    public function getConnectionsForUser()
    {
        $courseIds = CourseUser::query()->where('user_id', $this->user['id'])->pluck('course_id')->toArray();
        $studentIds = CourseUser::query()->whereIn('course_id', $courseIds)->pluck('user_id')->toArray();
        $teacherIds = Course::query()->whereIn('id', $courseIds)->pluck('default_teacher_id')->toArray();
        $subTeacherIds = Lesson::query()->whereIn('course_id', $courseIds)->pluck('substitute_teacher_id')->toArray();

        $ids = array_merge($studentIds,$subTeacherIds, $teacherIds);


        $connections = User::from('users AS u')
            ->leftJoin('profiles AS p', 'u.id', '=', 'p.user_id')
            ->leftJoin('course_users AS cu', 'cu.user_id', '=', 'u.id')
            ->whereIn('u.id', $ids)
            ->select(array_values(self::CONNECIONS_FIELDS))
            ->get()
            ->toArray();


//        $currentCourses = CourseUser::where('user_id', $this->user['id'])->pluck('course_id')->toArray();
//
//        $connections = User::from('users AS u')
//            ->leftJoin('course_users AS cu', 'u.id', '=', 'cu.user_id')
//            ->leftJoin('profiles AS p', 'u.id', '=', 'p.user_id')
//            ->leftJoin('courses AS c', 'u.id', '=', 'c.default_teacher_id')
//            ->whereIn('cu.course_id', $currentCourses)
//            ->select(array_values(self::CONNECIONS_FIELDS))
//            ->get();

        return $connections;
//        return collect([
//            'courseIds' => $courseIds,
//            'studentIds' => $studentIds,
//            'tea' => $teacherIds,
//            'sub' => $subTeacherIds
//        ]);
    }

    public function getRoles()
    {
        return Role::get();
    }
}
