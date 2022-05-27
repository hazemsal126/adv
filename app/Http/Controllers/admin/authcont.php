<?php

namespace App\Http\Controllers\admin;

use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class authcont extends Controller
{
    //

    public function index()
    {
        return view('admin.home');
    }

    public function edit()
    {
        $user = User::where('id',authid()->id)->first();
        return view('admin.users.profile',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        $val=Validator::make($request->all(),$user->rule_u(authid()->id));
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

            $user = User::where('id',authid()->id)->first();
            $user->update($input);
            $user->save();

            return r_back();
        }
        $error=$val->errors()->first();
        return r_backerror($error);
    }


    public function login(){
        return view('admin.login');
    }

    public function postIndex(Request $request)
    {
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required|string',
        ]);
        $username = $request->get('email');
        $password = $request->get('password');

        $admin['email'] = $username;
        $admin['password'] = $password;
        //$admin['isactive']=1;

        if (Auth::guard('web')->attempt($admin))
        {
            return redirect('/admin');
        }
        else
        {
            return redirect()->back();
        }
    }

    public function getLogout()
    {
        $user=authid();
        $user->fcm=null;
        $user->save();
        Auth::guard('web')->logout();
        return redirect('/admin');
    }

    public function getnotify(){
        Notification::where([['user_id',authid()->id],['created_at','<',Carbon::now()->subDays(10)]])->delete();
        $items=Notification::where([['user_id',authid()->id],['created_at','>',Carbon::now()->subDays(10)]])->orderby('id','desc')->get();
        $data=view('admin.include.notify',compact('items'))->render();
        return apisuccess($data,count($items));
    }
}
