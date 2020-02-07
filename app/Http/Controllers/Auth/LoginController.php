<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Route;
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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getToken(Request $request) {
        $request->request->add([
            'grant_type' => 'password',
            'client_id' => '2',
            'client_secret' => '24RGzrQtVItVLX9WS6aD2PGBnM5ZeZHJ3pG2J9ic',
            'username' => $request->username,
            'password' => $request->password
        ]);

        $requestToken = Request::create(env('APP_URL').'/oauth/token', 'post');
        $response = Route::dispatch($requestToken);
    
        return $response;
    }
}
