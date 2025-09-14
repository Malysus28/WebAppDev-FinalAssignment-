<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

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

               // ✅ If they clicked the "Organizer Login" button (?role=organiser),
        // make the logged-in user an organiser.
        if ($request->query('role') === 'organiser') {
            $user = Auth::user();
            if ($user && $user->type !== User::TYPE_ORGANISER) {
                $user->type = User::TYPE_ORGANISER;   // or just 'ORGANISER' if no constant
                $user->save();
            }
        }
// my experiment
        // return redirect()->intended(route('dashboard', absolute: false));
         return redirect()->intended(route('home'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

// my experiment
        // return redirect('/');
        return redirect()->route('home');
    }
}
