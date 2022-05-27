<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:customer-list|customer-create|customer-edit|customer-destroy', ['only' => ['index','store']]);
        $this->middleware('permission:customer-create', ['only' => ['create','store']]);
        $this->middleware('permission:customer-edit', ['only' => ['edit','update','makerer_update']]);
        $this->middleware('permission:customer-destroy', ['only' => ['destroy']]);
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
        $items = $items->where([['isadmin',0],['type','2']]);
        $items = $items->latest()->paginate(c_page());

        return view('admin.customer.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('admin.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request,User $customer)
    {
        $val=Validator::make($request->all(),$customer->rule());
        if($val->passes()) {
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $input['isadmin'] = 0;
            $input['type'] = '1';
            $input['is_terms'] = '1';
            $input['name'] =$request->fname.' '.$request->lname;

            if($request->hasFile('img')){
                $input['img'] = img_thum($request,'img',600,600);
            }
            $customer = User::create($input);
            return r_back();
        }
        $error=$val->errors()->first();
        return r_backerror($error);
    }

    public function edit($id)
    {
        $customer = User::find($id);
        return view('admin.customer.edit',compact('customer'));
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
            $input['name'] =$request->fname.' '.$request->lname;

            $customer = User::find($id);
            $customer->update($input);
            $customer->save();
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
