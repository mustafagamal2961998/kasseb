<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $checkAdmin = Admin::where('username',$request->username)->first();
        if(auth()->guard('admin')->check() &&  $checkAdmin->status !='active'){
            return redirect()->route('dashboard.auth.index')->with('error', 'عفوا هذا الحساب غير مفعل');
        }

        return $next($request);
    }
}
