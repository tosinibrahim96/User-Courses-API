<?php

use Illuminate\Database\Seeder;
use App\Course;
use App\User;

class CoursesUsersSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    $users = User::all();
    $courses = Course::all('id');
    $last_course_index = count($courses) - 1;

    for ($i = 0; $i < 5; $i++) {
      $user = $users[$i];
      if (count($courses)) {
        $user->courses()->attach($courses[rand(0, $last_course_index)]);
      }
    }
  }
}
