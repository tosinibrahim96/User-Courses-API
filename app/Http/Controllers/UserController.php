<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
  /**
   * Register new course(s) for user.
   *
   * @param  Request  $request
   * @return Response
   */

  public function registerCourses(Request $request)
  {
    try {
      $validator = Validator::make($request->all(), [
        'courses' => 'required|array|min:1',
      ]);

      if ($validator->fails()) {
        return $this->failureResponse($validator->errors()->toJson(), 400);
      }
      $user = Auth::user();
      $courses = Course::find($request->courses);

      foreach ($courses as $course) {
        $user->courses()->sync($course->id,false);
      }
      $user->courses;
      return $this->successResponse('Course registration succesfull.', 201, $user);
    } catch (\Throwable $th) {
      return  $this->failureResponse('Sorry, an error occured while processing this request', 500);
    }
  }
}
