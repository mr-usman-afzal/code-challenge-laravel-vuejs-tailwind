<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure(Request): (Response|\Illuminate\Http\RedirectResponse)  $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        {
            if ($request->user() && $request->user()->is_admin) {
                return $next($request);
            }

            return response()->json([
                'status' => false,
                'message' => 'You are unauthorized to perform this action.'
            ], 401);
        }
    }
}
