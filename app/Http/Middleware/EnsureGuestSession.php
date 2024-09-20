<?php

namespace App\Http\Middleware;

use App\Models\Guest;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class EnsureGuestSession
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() && !$request->session()->has('guest_id')) {
            $guest = Guest::create(['id' => (string) Str::uuid()]);
            if ($guest) {
                $request->session()->put('guest_id', $guest->id);
            }
        }
        return $next($request);
    }
}
