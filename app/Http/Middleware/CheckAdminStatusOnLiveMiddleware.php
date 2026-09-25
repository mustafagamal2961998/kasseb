<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminStatusOnLiveMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $checkAdmin = Admin::find(Auth::guard('admin')->id());
        if(auth()->guard('admin')->check() && $checkAdmin->status !='active'){
            Auth::guard('admin')->logout();
            return redirect()->route('dashboard.auth.index')->with('error', 'عفوا هذا الحساب غير مفعل');
        }

        return $next($request);
    }
}
