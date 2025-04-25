<?php

namespace App\Traits;

trait ResponseJson
{
  protected function successResponse($message = 'Success!', $data = [], $code = 200)
  {
    return response()->json(['status' => $code, 'message' => $message, 'data' => $data], $code);
  }

  protected function errorResponse($message = 'Error!', $code = 500, $data = [])
  {
    return response()->json(['status' => $code, 'message' => $message, 'data' => $data], $code);
  }
}