<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'teacher_id', 'grade'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class,'teacher_id', 'user_id');
    }

    public function parent()
    {
        return $this->hasOne(ParentModel::class, 'student_id', 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
