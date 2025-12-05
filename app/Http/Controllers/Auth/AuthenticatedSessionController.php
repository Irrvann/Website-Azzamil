<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->hasRole('super_admin')) {
            return redirect('/superadmin/dashboard')->with('welcome', 'Selamat datang Super Admin ' . $user->name . '!');
        } elseif ($user->hasRole('admin')) {
            return redirect('/admin/dashboard')->with('welcome', 'Selamat datang Admin ' . $user->name . '!');
        }
        // elseif ($user->hasRole('admin')) {
        //     return redirect('/sekolah/dashboard')->with('welcome', 'Selamat datang Kepala Sekolah ' . $user->name . '!');
        // } elseif ($user->hasRole('guru')) {
        //     return redirect('/guru/dashboard')->with('welcome', 'Selamat datang Guru ' . $user->name . '!');
        // } elseif ($user->hasAnyRole(['operator', 'guru_dan_operator'])) {
        //     return redirect('/operator/dashboard')->with('welcome', 'Selamat datang Operator ' . $user->name . '!');
        // }

        return redirect('/')->with('error', 'Role tidak dikenali!');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
