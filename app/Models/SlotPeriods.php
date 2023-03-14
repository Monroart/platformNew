<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlotPeriods extends Model
{
    public function teacher_slot()
    {
        return $this->belongsTo(TeacherSlot::class);
    }
}
