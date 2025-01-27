<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request): ?string
    {
        // Arahkan ke rute /auth jika pengguna belum login
        return $request->expectsJson() ? null : route('auth');
    }

    protected function unauthenticated($request, array $guards)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Anda harus login untuk mengakses halaman ini.'], 401);
        }

        parent::unauthenticated($request, $guards);
    }

}