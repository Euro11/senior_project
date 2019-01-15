<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'role';
    protected $fillable = ['role', 'role_name'];
}
