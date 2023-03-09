<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonDescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'user_id',
        'lesson_id'
    ];

    public function files()
    {
        return $this->hasMany(LessonFiles::class);
    }
}
