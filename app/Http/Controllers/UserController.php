<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\User\UserRepoInterface;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepoInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function all()
    {
        $users = $this->userRepository->getDatatable();
        return $this->successResponse(200, 'success', $users);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->errorResponse(400, 'Invalid login');
            }
        } catch (JWTException $e) {
            return $this->errorResponse(500, 'Cannot create token');
        }

        return $this->successResponse(200, 'success', compact('token'));
    }

    public function logout() {
        return $this->successResponse(200, 'logged out');
    }
}
