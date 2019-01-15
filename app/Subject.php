<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subject';
    protected $fillable = ['id', 'sub_name', 'sub_description', 'sub_unit'];
}
