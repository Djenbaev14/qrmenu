<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next,$role): Response
    { 
        // Foydalanuvchining roli mavjudligini tekshirish
        if (!Auth::check() || !Auth::user()->hasRole($role)) {
            // Agar roli yo'q bo'lsa, boshqa sahifaga qaytarish
            return redirect()->route('home')->with('error', 'Sizda ushbu sahifaga kirish huquqi yo‘q.');
        }
        return $next($request);
    }
}
