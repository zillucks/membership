<?php

namespace App\Http\Controllers;

use App\Models\Identity;
use App\Models\Member;
use App\Models\MemberType;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use Validator;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data['members'] = Member::whereHas('identity', function ($identity) use ($request) {
            $identity->filter($request)->orderBy('full_name', 'asc');
        })
        ->whereHas('role', function ($role) {
            $role->where('slug', '<>', 'administrator');
        })
        ->paginate(15);
        $data['members']->appends($request->query());

        return view('members.index', $data);
    }

    public function create(Request $request)
    {
        return new Member();
    }

    public function store(Request $request)
    {
        if (!$request->isMethod('post')) {
            $request->session()->flash('error', [
                'title' => "error 405",
                'message' => 'Method Not Allowed'
            ]);
            return redirect()->back();
        }

        return new Member();
    }

    public function edit(Request $request, Member $member)
    {
        $types = MemberType::latest()->pluck('member_type_name', 'id');
        $referrals = Member::with('identity')->where('id', '<>', $member->id)->get()->pluck('identity.full_name', 'id');
        return view('members.edit', compact(['member', 'types', 'referrals']));
    }

    public function update(Request $request, Member $member)
    {
        if (!$request->isMethod('put')) {
            $request->session()->flash('error', [
                'title' => "Error 405",
                'message' => 'Method Not Allowed'
            ]);
            return redirect()->back();
        }

        DB::beginTransaction();
        try {
            $member->current_point = $request->input('current_point');
            $member->referral_code = $request->input('referral_code');
            $member->referral_id = $request->input('referral_id');
            $member->member_type_id = $request->input('member_type_id');
            $member->registration_date = $request->input('registration_date');
            $member->verified_at = $request->input('verified_at');
            $member->is_verified = $request->has('is_verified') ? $request->input('is_verified') : false;
            $member->save();

            $identity = Identity::find($member->identity_id);
            $identity->full_name = $request->input('full_name');
            $identity->mobile_number = $request->input('mobile_number');
            $identity->address = $request->input('address');
            $identity->city = $request->input('city');
            $identity->state = $request->input('state');
            $identity->zip_code = $request->input('zip_code');

            $member->identity()->associate($identity);

            DB::commit();

            $request->session()->flash('success', [
                'title' => "Sukses",
                'message' => 'Proses Update data sukses'
            ]);

            return redirect()->route('admin.members');

        } catch (QueryException $e) {
            DB::rollback();
            $request->session()->flash('error', [
                'title' => "Error {$e->getCode()}!: ",
                'message' => $e->getMessage()
            ]);

            return redirect()->back()->with('error', $e->getMessage());
        }

        return $member;
    }

    public function delete(Request $request, Member $member)
    {
        if (!$request->isMethod('delete')) {
            $request->session()->flash('error', [
                'title' => "Error 405",
                'message' => 'Method Not Allowed'
            ]);
            return redirect()->back();
        }

        DB::beginTransaction();
        try {
            $member->transactions()->delete();
            $member->delete();

            $request->session()->flash('deleted', [
                'title' => 'Sukses.',
                'message' => "Data berhasil dihapus"
            ]);
            DB::commit();
        } catch (QueryException $e) {
            DB::rollback();
            $request->session()->flash('error', [
                'title' => "Error {$e->getCode()}",
                'message' => $e->getTrace()
            ]);
        }

        return $member;
    }

    public function destroy(Request $request, Member $member)
    {
        if (!$request->isMethod('delete')) {
            $request->session()->flash('error', [
                'title' => "Error 405",
                'message' => 'Method Not Allowed'
            ]);
            return redirect()->back();
        }

        return $member;
    }

    public function account(Request $request, Member $member)
    {
        return view('members.account', compact('member'));
    }

    public function accountUpdate(Request $request, Member $member)
    {
        $validator = Validator::make(
            $request->input(),
            [
                'password' => 'required|min:4'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user = User::find($member->identity->user_id);
            $user->password = $request->input('password');
            $user->save();

            $request->session()->flash('success', [
                'title' => 'Sukses',
                'message' => "Password User {$user->identity->full_name} berhasil diubah"
            ]);

            return redirect()->route('admin.members');
        }
        catch (QueryException $e)
        {
            $request->session()->flash('error', [
                'title' => "Error {$e->getCode()}",
                'message' => $e->getMessage()
            ]);
            
            return redirect()->back();
        }
    }

}
