<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $table = 'classroom';
    protected $fillable = ['id', 'section_id', 'student_id', 'created_at', 'updated_at'];
}