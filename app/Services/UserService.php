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
        if (session('guest_id')) {
            return Guest::find(session('guest_id'));
        } else {
            $guest = Guest::create(['id' => (string) Str::uuid()]);

            if ($guest) {
                session(['guest_id' => $guest->id]);
            }
            return $guest;
        }
    }
}
