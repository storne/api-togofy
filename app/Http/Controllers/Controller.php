<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function throwGenericException(\Exception $exception): JsonResponse
    {
        $codes = [400, 422, 401, 404, 500];

        if (in_array($exception->getCode(), $codes)) {
            return response()->json(['data' => $exception->getMessage()], $exception->getCode());
        }

        return response()->json(['data' => $exception->getMessage()], 500);
    }
}
