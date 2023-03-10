<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonFiles extends Model
{
    use HasFactory;

    protected $fillable = ['lesson_description_id', 'file_type', 'path'];

    public function lesson_descriptions()
    {
        return $this->belongsTo(LessonDescription::class);
    }

}
