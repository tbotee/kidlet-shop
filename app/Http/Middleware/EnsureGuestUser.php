<?php

namespace App\Http\Middleware;

use App\Services\UserService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class EnsureGuestUser
{
    public function __construct(public UserService $userService)
    {
    }

    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() && !session('guest_id')) {
            $this->userService->createGuestUser();
        }
        return $next($request);
    }
}
