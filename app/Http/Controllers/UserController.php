<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Modules\Quran\Entities\Para;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    use ValidatesRequests;
    function __construct()
    {
        $this->middleware('auth');

//        $this->middleware('permission:CORE', ['only' => ['index','create','store','edit','update','roleDelete']]);
//        $this->middleware('permission:CREATE', ['only' => ['create','store']]);
//        $this->middleware('permission:EDIT', ['only' => ['edit','update']]);
//        $this->middleware('permission:DELETE', ['only' => ['roleDelete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $users = User::orderBy('id','DESC')->paginate(20);
        return view("user.index", compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view("user.add",compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'roles' => 'required',
        ]);

        $input = $request->all();
        $emailExists = User::where('email',$input['email'])->count();
        if ($emailExists == 0 ){
            $input['password'] = Hash::make($input['password']);
            try{
                DB::beginTransaction();
                if ($UserData = User::create($input)) {
                    $UserData->save();

                    if ($request->roles) {
                        $UserData->assignRole($request->roles);
                    }
                }
                DB:: commit();
                Session::flash('message',__('quran::messages.Create Message'));
                return redirect()->route('user_list', app()->getLocale());
            }catch(Exception $ex){
                return \response([
                    'message'=>$ex->getMessage()
                ]);
            }
        }else{
            Session::flash('message',__('messages.emailExists'));
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language,$id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view("user.edit",compact('user','roles','userRole'));
    }


    public function update(Request $request, $language,$id)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'roles' => 'required',
        ]);

        $input = $request->all();
        $emailExists = User::where('email',$input['email'])->first();
        $emailCount = User::where('email',$input['email'])->count();

        if (($emailCount == 0) || ($emailCount == 1 && $emailExists->id == $id)){
            DB::beginTransaction();
            try {
                $result = $emailExists->update($input);
                $emailExists->save();

                DB::table('model_has_roles')->where('model_id', $id)->delete();
                $emailExists->assignRole($request->input('roles'));

                DB::commit();

                Session::flash('message', __('quran::messages.Update Message'));
                return redirect()->route('user_list', app()->getLocale());

            } catch (\Exception $e) {
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }
        }else{
            Session::flash('message',__('messages.emailExists'));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
