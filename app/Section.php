<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'section';
    protected $fillable = ['id', 'name', 'year', 'subject_id', 'std_count', 'class_date', 'class_day'];

    public function users()
    {
    	return $this->belongsToMany('App\User');
    }
}
