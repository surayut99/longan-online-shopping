<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    public function prelogin(Request $request){
        $request->validate([
            'username' => "required",
            'password' => "required"
        ], [
            'username.required' => 'กรุณาใส่ชื่อผู้ใช้',
            'password.required' => 'กรุณาใส่รหัสผ่าน',
        ]);
        $user = User::where('username','=',$request->input('username'))->first();
        if(!$user){
            return redirect()->back() ->withInput()->withErrors(['username' => 'รหัสผ่านไม่ถูกต้อง']);
        }
        if(Hash::check($request->input('password'),$user->password)){
            Auth::login($user);
            return redirect()->route('pages.home');
        }
        return redirect()->back() ->withInput()->withErrors(['password' => 'รหัสผ่านไม่ถูกต้อง']);
    }
}
