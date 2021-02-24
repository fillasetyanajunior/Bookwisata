<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AdminMitra
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (request()->user()->role == 1 || request()->user()->role == 2) {
            if (request()->user()->active_mitra == date('Y-m-d')) {
                User::where('id',request()->user()->id)
                    ->update([
                        'role' => 3,
                    ]);
            }else{
                return $next($request);
            }
        }
        return redirect()->route('home');
    }
}
