<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Validator;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:administrator');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'desc')->get();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('roles.create');
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
                'role_name' => 'required|unique:roles'
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $role = new Role();
            $role->role_name = $request->input('role_name');
            if ($request->has('is_active')) {
                $role->is_active = $request->input('is_active');
            }
            $role->save();
            
            $request->session()->flash('success', [
                'title' => 'Sukses',
                'message' => "Pembuatan Role {$request->input('role_name')} berhasil"
            ]);

            return redirect()->route('admin.roles');

        }
        catch(QueryException $e) {
            $request->session()->flash('error', [
                'title' => "Error {$e->getCode()}",
                'message' => $e->getMessage()
            ]);
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validator = Validator::make(
            $request->input(),
            [
                'role_name' => 'required|unique:roles,role_name,' . $role->id
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $role->role_name = $request->input('role_name');
            if ($request->has('is_active')) {
                $role->is_active = $request->input('is_active');
            }
            else {
                $role->is_active = false;
            }
            $role->save();
            
            $request->session()->flash('success', [
                'title' => 'Sukses',
                'message' => "Update Role {$request->input('role_name')} berhasil"
            ]);

            return redirect()->route('admin.roles');

        }
        catch(QueryException $e) {
            $request->session()->flash('error', [
                'title' => "Error {$e->getCode()}",
                'message' => $e->getMessage()
            ]);
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, Role $role)
    {
        try {
            $role->delete();

            $request->session()->flash('deleted', [
                'title' => "Sukses",
                'message' => "Role {$role->getOriginal('role_name')} berhasil dihapus"
            ]);
        }
        catch(QueryException $e) {
            $request->session()->flash('error', [
                'title' => "Error {$e->getCode()}",
                'message' => $e->getMEssage()
            ]);
            return redirect()->back();
        }
    }
}
