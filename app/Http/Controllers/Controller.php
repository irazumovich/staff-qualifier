<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function responseOk($data = [], $status = 200)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'status' => $status
        ]);
    }

    public function responseFail($errors = [], $status = 404)
    {
        return response()->json([
            'success' => false,
            'errors' => $errors,
            'status' => $status
        ]);
    }
}
