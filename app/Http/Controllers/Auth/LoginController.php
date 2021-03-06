<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    public function username()
    {
        return 'phone';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        $phone = preg_replace('/^(0|254)/', '+254', $request->get('phone'));
        return ['mobile'=>$phone,'password'=>$request->get('password')];
    }

    public function validate(Request $request, array $rules, array $messages = [], array $customAttributes = [])
    {
        $credentials = $this->credentials($request);

        $remember_me = $request->has('remember');

        if (Auth::attempt($credentials, $remember_me)) {
            $user = auth()->user();

            Auth::login($user,true);
        }else{

            return back()->with('error','Your credentials are not correct.');

        }
    }
}
