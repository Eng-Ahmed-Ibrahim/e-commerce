<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // For web sessions, simply redirect to the login page if the user is not authenticated
        if (!$request->expectsJson()) {
            return route('login');
        }

        // Optionally, handle custom responses for JSON requests (e.g., AJAX requests)
        return null;
    }
}
