<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\View\View;

class Controller
{
    public function showLogin(): View
    {
        return view('login');
    }

    public function showRegister(): View
    {
        return view('register');
    }

    public function redirectToProvider(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(string $provider)
    {
        $socialUser = Socialite::driver($provider)->stateless()->user();

        $email = $socialUser->getEmail() ?: sprintf('%s_%s@social.local', $provider, $socialUser->getId());
        $name = $socialUser->getName() ?: $socialUser->getNickname() ?: $provider . ' User';

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make(Str::random(24)),
            ]
        );

        Auth::login($user);

        return redirect()->route('task_kategori.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return Redirect::back()->withInput($request->except('password'))->withErrors([
                'email' => 'Email atau password salah.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('task_kategori.index'));
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::create($data);

        Auth::login($user);

        return redirect()->route('task_kategori.index');
    }
}
