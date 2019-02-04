<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckAttendance extends Model
{
    protected $table = 'check_attendance';
    protected $fillable = ['id', 'user_lat', 'user_lon', 'distance', 'classroom_id', 'status_check', 'created_at', 'updated_at'];
}
