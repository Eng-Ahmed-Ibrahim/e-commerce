<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Str;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        try {

            // Check if the user is authenticated via JWT
            if ($request->bearerToken()) {
                $user = JWTAuth::parseToken()->authenticate();

                // If JWT token is valid, add the authenticated user to the request
                if ($user) {
                    $request->merge(['user' => $user]);
                } else {
                    return response()->json(['message' => 'Unauthorized'], 401);
                }
                
            } else {
                // If there is no JWT token, ensure a guest_id exists for guest users
                    session(['guest_id' => $request->guest_id]);
                
            }
        } catch (\Exception $e) {
            // Token is invalid or missing, treat as a guest
            if (!session()->has('guest_id')) {
                $guest_id = Str::random(16);  // Generate a random guest ID
                session(['guest_id' => $guest_id]);  // Store it once in session
            }
        }

        // Proceed with the request
        return $next($request);
    }
}
