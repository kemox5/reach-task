<?php

namespace App\Http\Controllers;

class ApisController extends Controller
{
      public function success($data = null, String $message = null)
      {
            return response()->json([
                  'success' => true,
                  'message' => $message ?? null,
                  'data' => $data
            ], 200);
      }
}
