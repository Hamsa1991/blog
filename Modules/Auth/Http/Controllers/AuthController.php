<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Modules\Auth\Http\Requests\LoginRequest;
use Modules\Auth\Http\Requests\SignUpRequest;
use Modules\Auth\Http\Resources\LoginResource;
use Modules\Auth\Services\AuthService;
use Modules\Auth\Transformers\UserResource;

class AuthController extends Controller
{
    use HttpResponse;
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Register a new user
     */
    public function signup(SignUpRequest $request)
    {
        try {
            $result = $this->authService->register($request->validated());

            return new LoginResource($result);

        } catch (\Exception $e) {
            return $this->errorResponse(
                message: $e->message
        }
    }

    /**
     * Login user
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $result = $this->authService->login($request->validated());

            return new LoginResource($result);

        }catch (\Exception $exception){
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * Logout user
     */
    public function logout(Request $request): JsonResponse
    {
        try {
            $this->authService->logout($request->user());

            return $this->okResponse('logged out successfully');

        } catch (\Exception $exception){
            return $this->errorResponse($exception->getMessage());
        }
    }

    public function verifyEmail($id){
        try{
            $result = $this->authService->verifyEmail($id);

            return new UserResource($result['user']);

        }catch (\Exception $exception){
            return $this->errorResponse($exception->getMessage());
        }
    }
}
