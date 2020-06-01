<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Jobs\CreateCourses;
use Illuminate\Support\Facades\Auth;
use App\Exports\CoursesExport;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class CourseController extends Controller
{
  /**
   * Get all courses.
   *
   * @param  Request  $request
   * @return Response
   */

  public function index(Request $request)
  {

    try {
      $user = Auth::user();
      $courses = Course::paginate(10);
      $user_courses = $user->courses->toarray();
      $user_courses_ids = [];

      foreach ($user_courses as $user_course) {
        array_push($user_courses_ids, $user_course['pivot']['course_id']);
      }

      foreach ($courses as $course) {
        if (in_array($course->id, $user_courses_ids)) {
          $course['date_enrolled'] = $this->getDateEnrolled($user, $course);
        } else {
          $course['date_enrolled'] = null;
        }
      }

      return $this->successResponse('Courses retrieved successfully.', 200, $courses);
    } catch (\Throwable $th) {
      return  $this->failureResponse('Sorry, an error occured while processing this request', 500);
    }
  }



  /**
   * Store new courses with a Job.
   *
   * @param  Request  $request
   * @return Response
   */

  public function store(Request $request)
  {
    try {
      CreateCourses::dispatchNow();
      return $this->successResponse('Courses created succesfully.', 201, Course::paginate(10));
    } catch (\Throwable $th) {
      return  $this->failureResponse('Sorry, an error occured while processing this request', 500);
    }
  }


  /**
   * Get the date user enrolled for a course.
   *
   * @param  User  $user
   * @param  Course  $course
   * @return Date
   */

  public function getDateEnrolled($user, $course)
  {
    $result = DB::table('course_user')->select('created_at')->where('user_id', $user->id)->where('course_id', $course->id)->first();
    return $result->created_at;
  }


  /**
   * Export all courses into a courses.xlsx file.
   * @return File
   */
  public function export()
  {
    try {
      return Excel::download(new CoursesExport(), 'courses.xlsx');
    } catch (\Throwable $th) {
      return  $this->failureResponse('Sorry, an error occured while processing this request', 500);
    }
  }
}
