<?php

namespace App\Http\Middleware;

use Closure;

class Niezalogowany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->session()->exists('uczestnik')) {
            return redirect('/home');
        }

        return $next($request);
    }
}
