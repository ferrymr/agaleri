<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\UserDetail;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

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
            'name' => 'required|string|max:255',
            'idsponsor_1' => 'required|integer|min:1|max:6',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:1|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

      UserDetail::create([
          'id' => '1',
          'name' => $data['name'],
          'gender' => '',
          'noktp' => '',
          'ttl' => '',
          'alamat' => '',
          'kota' => '',
          'kode_pos' => '',
          'negara' => '',
          'img_ktp' => '',
          'img_rek' => '',
          'img_npwp' => '',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);

        return User::create([
            'id' => '1',
            'name' => $data['name'],
            'idsponsor_1' => $data['idsponsor_1'],
            'idsponsor_2' => '0',
            'idsuper_leader' => '0',
            'idmesin' => '0',
            'isactive' => 'N',
            'ismesin' => 'OM',
            'ispriv' => 'ADM',
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

    }
}
