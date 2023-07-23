<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Response\ApiResponse;
use App\Services\Api\Auth\RegisterService;
use Exception;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    /**
     * @param  RegisterRequest  $request
     * @param  RegisterService  $registerService
     * @return JsonResponse
     * @throws Exception
     */
    public function __invoke(RegisterRequest $request, RegisterService $registerService): JsonResponse
    {
        $registeredUser = $registerService->register($request->validated());

        return ApiResponse::token($registeredUser);
    }
}
