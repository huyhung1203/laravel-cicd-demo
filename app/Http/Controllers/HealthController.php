<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HealthController extends Controller
{
    //
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'status' => 'ok',
            'app' => 'laravel-cicd-demo',
        ]);
    }
}
