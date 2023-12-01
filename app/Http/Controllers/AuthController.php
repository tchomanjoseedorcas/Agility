<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest\LoginRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private User $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function loginPage(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('login');
    }

    public function login(LoginRequest $request): string|RedirectResponse
    {
        if (Auth::attempt($request->loginAttributes())) {
            $user = $this->user->findUserByEmailOrContact($request->loginAttributes());
            Auth::login($user);
            return redirect()->route('dashboard');
        }
        session()->put('email', $request->input('email'));
        return redirect()->route('login')->with('error', 'identifiant ou mot de passe incorrect');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
