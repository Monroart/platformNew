<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubjectMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'material_link',
        'subject_material',
        'subject_id'
    ];
}
