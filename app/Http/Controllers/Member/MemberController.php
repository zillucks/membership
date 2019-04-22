<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Identity;
use App\Models\Member;
use App\Models\PointTransaction AS Transaction;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use Validator;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:member');
    }

    public function index()
    {
        $data['user'] = Auth::user();
        return view('member-area.home', $data);
    }

    public function profile()
    {
        $data['member'] = Auth::user()->member;

        return view('member-area.profile', $data);
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make(
            $request->input(),
            [
                'full_name' => 'required',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $identity = Identity::find(Auth::user()->identity->id);
            $identity->full_name = $request->input('full_name');
            $identity->mobile_number = $request->input('mobile_number');
            $identity->address = $request->input('address');
            $identity->city = $request->input('city');
            $identity->state = $request->input('state');
            $identity->zip_code = $request->input('zip_code');
            $identity->save();

            $request->session()->flash('success', [
                'title' => "Sukses",
                'message' => 'Proses Update data sukses'
            ]);

            return redirect()->back();
        }
        catch(QueryException $e) {
            $request->session()->flash('error', [
                'title' => "Error {$e->getCode()}",
                'message' => $e->getMessage()
            ]);
            
            return redirect()->back()->withInput();
        }

    }

    public function verify()
    {
        $data['user'] = Auth::user();
        if (Auth::user()->isVerified()) {
            return redirect()->intended('/');
        }
        return view('member-area.verify', $data);
    }

    public function transaction(Request $request)
    {
        if (!Auth::user()->isVerified()) {
            return redirect()->intended('/');
        }

        $data['user'] = Auth::user();
        $data['transactions'] = Transaction::where('member_id', Auth::user()->member->id)->paginate(20);
        $data['transactions']->appends($request->query());
        
        return view('member-area.transaction', $data);
    }
}
