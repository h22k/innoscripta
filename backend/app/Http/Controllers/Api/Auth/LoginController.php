<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Response\ApiResponse;
use App\Services\Api\Auth\LoginService;
use Illuminate\Http\JsonResponse;
use Throwable;

class LoginController extends Controller
{
    /**
     * @param  LoginRequest  $request
     * @param  LoginService  $loginService
     * @return JsonResponse
     * @throws Throwable
     */
    public function __invoke(LoginRequest $request, LoginService $loginService): JsonResponse
    {
        $loggedInUser = $loginService->login($request->validated());

        return ApiResponse::token($loggedInUser);
    }
}
