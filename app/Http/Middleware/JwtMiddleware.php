<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{

  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    try {
      $user = JWTAuth::parseToken()->authenticate();
    } catch (Exception $e) {
      if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
        return $this->failureResponse('Token is invalid', 401);
      } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
        return $this->failureResponse('Token is Expired', 401);
      } else {
        return $this->failureResponse('Authorization Token not found', 401);
      }
    }
    return $next($request);
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
