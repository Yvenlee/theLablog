<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/';
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            // Mise à jour de la dernière date de connexion
            $request->user()->update(['last_login_at' => now()]);

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis sont incorrects.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended($this->redirectTo());
    }


    protected function redirectTo()
    {
        return $this->redirectTo;
    }
}

