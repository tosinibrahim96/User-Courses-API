<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  /**
   * Return success response for all controllers.

   * @param  string $message
   * @param int $statusCode
   * @param mixed $data
   * @return \Illuminate\Http\JsonResponse
   *
   */
  protected function successResponse($message, $statusCode, $data)
  {
    return  response()->json([
      'status' => true,
      'message' => $message,
      'data' => $data
    ], $statusCode);
  }


  /**
   * Return failure response for all controllers.

   * @param  string $message
   * @param int $statusCode
   * @return \Illuminate\Http\JsonResponse
   *
   */
  protected function failureResponse($message, $statusCode)
  {
    return  response()->json([
      'status' => false,
      'message' => $message,
    ], $statusCode);
  }
}
