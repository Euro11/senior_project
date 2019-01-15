<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    protected $table = 'week';
    protected $fillable = ['id', 'day_name'];
}
