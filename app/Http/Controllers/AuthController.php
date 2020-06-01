<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use JWTAuth;


class AuthController extends Controller
{
  /**
   * Create a new user
   *
   * @param  Request  $request
   * @return Response
   */

  public function register(Request $request)
  {
    try {

      $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
      ]);

      if ($validator->fails()) {
        return $this->failureResponse($validator->errors()->toJson(), 400);
      }

      $user = new User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->save();

      $token = JWTAuth::fromUser($user);

      return $this->successResponse('User account created.', 201, compact('user', 'token'));
    } catch (\Exception $e) {
      return  $this->failureResponse('Sorry, an error occured while processing this request', 500);
    }
  }


  /**
   * Login a user
   *
   * @param  Request  $request
   * @return Response
   */

  public function login(Request $request)
  {
    try {
      $credentials = $request->only('email', 'password');

      if (!$token = JWTAuth::attempt($credentials)) {
        return  $this->failureResponse('Unauthorized. Login failed', 401);
      }

      $user = Auth::user();
      return $this->successResponse('Login successful', 200, compact('user', 'token'));
    } catch (\Exception $e) {
      return  $this->failureResponse('Sorry, an error occured while processing this request', 500);
    }
  }

  /**
   * Log the user out (Invalidate the token)
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function logout()
  {
    try {
      Auth::logout();
      return $this->successResponse('Logout successful', 200, null);
    } catch (\Throwable $th) {
      return  $this->failureResponse('Sorry, an error occured while processing this request', 500);
    }
  }
}
