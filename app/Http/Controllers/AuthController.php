<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Display the admin login form.
     */
    public function showLoginForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('admin.products.index');
        }

        return view('auth.login');
    }

    /**
     * Authenticate an admin user using username and password.
     */
    public function login(Request $request): RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('admin.products.index');
        }

        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()
                ->intended(route('admin.products.index'))
                ->with('success', 'Berhasil masuk ke Panel Admin Distro Aseli Aseli.');
        }

        return back()
            ->withErrors([
                'username' => 'Username atau password tidak sesuai.',
            ])
            ->onlyInput('username');
    }

    /**
     * Log the authenticated admin out and invalidate the session.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Anda telah keluar dari Panel Admin.');
    }
}
