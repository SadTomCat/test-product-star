<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LessonUser extends Model
{
    use HasFactory;

    protected $table = 'lesson_user';

    protected $fillable = ['user_id', 'lesson_id', 'is_completed'];
}
