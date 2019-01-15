<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $table = 'classroom';
    protected $fillable = ['id', 'section_id', 'teacher_id', 'student_id'];
