<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard'; // Ubah redirect path ke '/dashboard' setelah login berhasil

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the post login redirect path.
     *
     * @return string
     */
    public function redirectTo()
    {
        return route('dashboard'); // Mengarahkan pengguna ke route dengan nama 'dashboard' setelah login berhasil
    }

    /**
     * The user has logged in.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended($this->redirectPath()); // Mengarahkan pengguna ke path yang diminta sebelumnya atau $redirectTo
    }
}
