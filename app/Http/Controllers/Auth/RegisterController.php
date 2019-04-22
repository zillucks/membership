<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Identity;
use App\Models\Member;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

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
    protected $redirectTo = '/member/verify';

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
            'full_name' => ['required', 'string', 'max:255'],
            'mobile_number' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'referral_code' => ['nullable', 'exists:member,referral_code'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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

        DB::beginTransaction();
        try {
            $user = new User();
            $user->email = $data['email'];
            $user->password = $data['password'];
            $user->save();

            $identity = new Identity();
            $identity->full_name = $data['full_name'];
            $identity->email = $data['email'];
            $identity->mobile_number = $data['mobile_number'];

            $user->identity()->save($identity);

            $member = new Member();
            $member->member_type_id = 1;
            $member->role_id = 2;

            if (!empty($data['referral_code'])) {
                $referral = Member::where('referral_code', $data['referral_code'])->first();
                $member->referral_id = $referral->id;
            }

            $user->identity->member()->save($member);

            DB::commit();

            return $user;
        } catch (QueryException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }
}
