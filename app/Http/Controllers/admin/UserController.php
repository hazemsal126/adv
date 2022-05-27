<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-destroy', ['only' => ['index','store']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $items = new User();
        if(request('name')){
            $items = $items->where('name', 'like', '%' . request('name') . '%');
        }
        if(request('phone')){
            $items = $items->where('phone', 'like', '%' . request('phone') . '%');
        }

        if(request('email')){
            $items = $items->where('email','like', '%' . request('email') . '%');
        }
        $items = $items->where([['isadmin',1],['type','0']]);
        $items = $items->latest()->paginate(c_page());

        return view('admin.users.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.users.create',compact('roles'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request,User $user)
    {
        $val=Validator::make($request->all(),$user->rule());
        if($val->passes()) {
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $input['isadmin'] = 1;
            if($request->hasFile('img')){
                $input['img'] = img_thum($request,'img',600,600);
            }
            $user = User::create($input);
            $user->assignRole($request->input('roles'));
            return r_back();
        }
        $error=$val->errors()->first();
        return r_backerror($error);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('admin.users.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,User $user)
    {
        $val=Validator::make($request->all(),$user->rule_u($id));
        if($val->passes()) {
            $input = $request->all();
            if(!empty($input['password'])){
                $input['password'] = Hash::make($input['password']);
            }else{
                $input = Arr::except($input,array('password'));
            }
            if($request->hasFile('img')){
                $input['img'] = img_thum($request,'img',600,600);

            }else{
                $input = Arr::except($input,array('img'));
            }

            $user = User::find($id);
            $user->update($input);
            $user->save();
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole($request->input('roles'));
            return r_back();
        }
        $error=$val->errors()->first();
        return r_backerror($error);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        if ($id != 1) {
            $item = User::find($id);
            if (isset($item)) {
                User::destroy($id);
                return r_back();
            }
        }
        return error_back();
    }
}
