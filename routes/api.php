<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$router->group(['prefix' => 'v1/'], function () use ($router) {

  $router->group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');
  });


  $router->group(['middleware' => ['jwt.verify']], function ($router) {
    $router->post('courses', 'CourseController@store');
    $router->get('courses', 'CourseController@index');
    $router->get('courses/export', 'CourseController@export');
    $router->post('user/register-courses', 'UserController@registerCourses');
    $router->post('auth/logout', 'AuthController@logout');
  });
});
