<?php

namespace App\Services;

use App\Models\Guest;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserService
{
    public function getAuthenticatedUser(): Authenticatable|Guest
    {
        if (Auth::check()) {
            return Auth::user();
        } else {
            return $this->getGuestUser();
        }
    }

    private function getGuestUser(): Guest
    {
       return Guest::find(session('guest_id'));
    }

    public function createGuestUser(): Guest
    {
        $guest = Guest::create(['id' => (string) Str::uuid()]);
        session(['guest_id' => $guest->id]);
        return $guest;
    }
}
