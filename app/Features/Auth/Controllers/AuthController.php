<?php
namespace App\Features\Auth\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// ponytail: session auth with simple redirect; add token-based sanctum when mobile client connects.
class AuthController extends Controller {
    public function showLogin() { return view('auth.login'); }
    public function login(Request $request) {
        $credentials = $request->validate(['email' => 'required|email', 'password' => 'required']);
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }
        return back()->withErrors(['email' => 'Kredensial tidak valid.']);
    }
    public function showRegister() { return view('auth.register'); }
    public function register(Request $request) {
        $val = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);
        $user = User::create(['name' => $val['name'], 'email' => $val['email'], 'password' => Hash::make($val['password']), 'role' => 'siswa']);
        Auth::login($user);
        return redirect()->route('dashboard');
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
