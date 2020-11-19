<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PreValidateController;
use App\Models\Customer;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Rules\TelNumberRule;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'name' => ['required', 'string', 'max:255'],
            'telephone' => ['required', new TelNumberRule()],
            'address' => ["required", 'string', 'max:255'],
        ],[
            'username.required' => 'กรุณากรอกชื่อผู้ใช้',
            'username.unique' => 'มีชื่อผู้ใช้นี้แล้ว',
            'password.required' => 'กรุณากรอกรหัสผ่าน',
            'password.confirmed' => 'รหัสผ่านไม่ตรงกัน',
            'password.min' => 'กรุณากรอกรหัสผ่านมากกว่า 8 ตัว',
            'name.required' => 'กรุณากรอกชื่อ-สกุล',
            'telephone.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'address.required' => 'กรุณากรอกที่อยู่',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            // 'name' => $data['name'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);
        $customer = new Customer();
        $customer->user_id = $user->id;
        $customer->name = $data['name'];
        $customer->telephone = $data['telephone'];
        $customer->address = $data['address'];
        $customer->save();
        return $user ;
    }
}
