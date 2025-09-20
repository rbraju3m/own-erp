<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use DB;
use Image;
use File;
use Storage;
use App;
Use Auth;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');

//        $this->middleware('permission:CORE', ['only' => ['index','create','store','edit','update','roleDelete']]);
//        $this->middleware('permission:CREATE', ['only' => ['create','store']]);
//        $this->middleware('permission:EDIT', ['only' => ['edit','update']]);
//        $this->middleware('permission:DELETE', ['only' => ['roleDelete']]);
    }
    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $roles = Role::orderBy('id','DESC')->get();

        return view("role.index", compact('roles'));
    }

    public function create(){
        $permissions = Permission::all()->groupBy('module');
        return view("role.add", compact('permissions'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        Session::flash('message',__('quran::messages.Create Message'));
        return redirect()->route('role_list', app()->getLocale());
    }

    /*public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'required|array',
        ]);

        DB::transaction(function () use ($request) {
            $role = Role::create([
                'name' => $request->name,
                'guard_name' => 'web'
            ]);

            $role->syncPermissions($request->permissions);

            // optional: assign role to user immediately
            if ($request->has('user_id')) {
                $user = User::findOrFail($request->user_id);
                $user->assignRole($role);
            }
        });

        return redirect()->route('role_list')->with('success', 'Role created successfully.');
    }*/


    public function edit($language,$id){
        $role = Role::find($id);
        $permission = Permission::get();

        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view("role.edit", compact('role','permission','rolePermissions'));
    }

    public function update(Request $request,$language, $id){
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        Session::flash('message', __('quran::messages.Update Message'));
        return redirect()->route('role_list', app()->getLocale());
    }

    public function roleDelete($language,$id){
        DB::table('roles')->where('id', $id)->delete();

        Session::flash('delete',__('quran::messages.Delete Message'));
        return redirect()->route('role_list', app()->getLocale());
    }

}
