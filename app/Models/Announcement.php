<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'created_by','target_students','target_parents'];

    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
