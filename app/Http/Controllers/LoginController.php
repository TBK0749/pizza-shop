<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Handle account login request
     *
     * @param LoginRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if (!Auth::validate($credentials)) :
            return redirect()->to('login')
                ->withErrors(trans('auth.failed'));
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);

        return $this->authenticated($request, $user);
    }

    /**
     * Handle response after user authenticated
     *
     * @param Request $request
     * @param Auth $user
     *
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        // if (auth()->attempt(array('email' => Auth::user($user)->email, 'password' => Auth::user($user)->password))) {
        //     if (Auth::user($user)->is_admin == 1) {
        //         return redirect()->route('admin.home');
        //     } else {
        //         return redirect()->route('home.index');
        //     }
        // } else {
        //     return redirect()->route('login.show')->with('error', 'Email-address and Password are wrong.');
        // }

        if (Auth::user($user)->is_admin == 1) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('home.index');
        }
    }
}
