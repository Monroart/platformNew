<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'time',
        'day_of_the_week',
        'period_id',
        'type',
        'course_id'
    ];
}
