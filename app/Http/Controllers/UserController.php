<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Identity;
use App\Models\Member;
use App\Models\MemberType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Auth;
use Carbon\Carbon;
use Validator;

use App\Models\PointTransaction as Transaction;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['users'] = User::with([
            'member' => function ($member) {
                $member
                    ->orderBy('role_id', 'asc')
                    ->orderBy('is_verified', 'desc')
                    ->orderBy('verified_at', 'desc');
            }
        ])
        ->paginate(10);
        $data['users']->appends($request->query());

        return view('users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['roleLists'] = Role::orderBy('role_name', 'asc')->where('slug', '<>', 'member')->pluck('role_name', 'id');
        $data['memberTypeLists'] = MemberType::orderBy('member_type_name', 'asc')->pluck('member_type_name', 'id');
        return view('users.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->input(),
            [
                'email' => 'email|required|unique:users',
                'password' => 'required|confirmed',
                'full_name' => 'required',
                'mobile_number' => 'required'
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $user = new User();
            $user->email = $request->input('email');
            $user->email_verified_at = Carbon::now();
            $user->password = $request->input('password');
            $user->user_log = Auth::user()->identity->full_name;
            $user->save();

            $identity = new Identity();
            $identity->full_name = $request->input('full_name');
            $identity->email = $user->email;
            $identity->mobile_number = $request->input('mobile_number');
            $identity->address = $request->input('address');
            $identity->city = $request->input('city');
            $identity->state = $request->input('state');
            $identity->zip_code = $request->input('zip_code');
            $identity->user_log = Auth::user()->identity->full_name;
            $user->identity()->save($identity);

            $member = new Member();
            $member->member_type_id = $request->input('member_type_id');
            if ($request->has('is_admin')) {
                $member->role_id = $request->input('role_id');
            }
            else {
                $role = Role::where('slug', 'member')->first();
                $member->role_id = $role->id;
            }
            // $member->role_id = $request->has('is_admin') ? 1 : 2; // 1: administrator, 2: member
            $member->verified_at = Carbon::now();
            $member->is_verified = true;
            $member->user_log = Auth::user()->identity->full_name;

            $user->identity->member()->save($member);

            DB::commit();

            $request->session()->flash('success', [
                'title' => 'Sukses: ',
                'message' => "Data User {$user->identity->full_name} berhasil disimpan"
            ]);

            return redirect()->route('admin.users');

        } catch (QueryException $e) {
            DB::rollback();
            $request->session()->flash('error', [
                'title' => "Error {$e->getCode()}: ",
                'message' => $e->getMessage()
            ]);
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {
        $data['tab'] = 'profile-tab';
        return view('users.view', ['user' => $user, 'tab' => $data['tab']]);
    }

    public function showTab(User $user, $tab)
    {
        return view("users.tablists.{$tab}", compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make(
            $request->input(),
            [
                'full_name' => 'required',
                'password' => 'confirmed'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        DB::beginTransaction();

        try {

            $user = User::find(Auth::user()->id);

            if (!is_null($request->input('password'))) {
                $user->password = $request->input('password');
                $user->save();
            }

            $identity = Identity::find(Auth::user()->identity->id);
            $identity->full_name = $request->input('full_name');
            $identity->address = $request->input('address');
            $identity->city = $request->input('city');
            $identity->state = $request->input('state');
            $identity->zip_code = $request->input('zip_code');
            $user->identity()->save($identity);

            DB::commit();

            $request->session()->flash('success', [
                'title' => 'Sukses: ',
                'message' => "Data User {$user->identity->full_name} berhasil disimpan"
            ]);

            return redirect()->route('admin.users');

        } catch (QueryException $e) {
            DB::rollback();
            $request->session()->flash('error', [
                'title' => "Error {$e->getCode()}: ",
                'message' => $e->getMessage()
            ]);
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, User $user)
    {
        DB::beginTransaction();
        try {
            $user->delete();
            DB::commit();
            $request->session()->flash('deleted', [
                'title' => 'Sukses.',
                'message' => "Data berhasil dihapus"
            ]);

            return $user;

        } catch (QueryException $e) {
            DB::rollback();
            $request->session()->flash('error', [
                'title' => "Error {$e->getCode()}",
                'message' => $e->getTrace()
            ]);
        }
    }
}
