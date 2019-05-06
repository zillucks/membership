<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Member;
use App\Models\PointTransaction as Transaction;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['users'] = User::with([
            'identity' => function ($identity) {
                $identity->orderBy('full_name', 'desc');
            }
        ])->paginate(20);

        $data['verified_member'] = Member::whereDoesntHave('role', function ($role) {
            $role->whereIn('slug', ['administrator', 'staff']);
        })->where('is_verified', true)->count();

        $data['unverified_member'] = Member::whereDoesntHave('role', function ($role) {
            $role->whereIn('slug', ['administrator', 'staff']);
        })->where('is_verified', false)->count();

        $data['platinum_member'] = Member::whereHas('member_type', function ($type) {
            $type->whereRaw('lower(member_type_name) = ?', 'platinum');
        })->count();

        $data['transactions'] = Transaction::whereIn('transaction_status', ['canceled', 'confirmed'])->orderBy('invoice_date', 'desc')->take(10)->get();

        return view('home', $data);
    }
}
