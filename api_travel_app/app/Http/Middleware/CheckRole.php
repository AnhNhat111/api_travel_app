<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\role;
use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // $checkRole = role::with(['checkRole'])
        // ->where('role_id', 1);
        // $checkRole = $request->input('checkRole');
        // if($checkRole == 1){
        //     return $next($request);
        // }
    }
}
