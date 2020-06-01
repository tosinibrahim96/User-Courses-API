<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'text', 'description', 'max_students', 'instructor_name',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'created_at', 'updated_at'
  ];

  /**
   * The users that belong to the course.
   */
  public function users()
  {
    return $this->belongsToMany('App\User')->withTimestamps();
  }
}
