<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    //

    function __construct()
    {
        $this->middleware('permission:country-list|country-create|country-edit|country-destroy', ['only' => ['index','store']]);
        $this->middleware('permission:country-create', ['only' => ['create','store']]);
        $this->middleware('permission:country-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:country-destroy', ['only' => ['destroy']]);
    }
    //
    public function index(){
        $id=\request('id');
        $cat=Country::find($id);
        $items = new City();
        if(request('name')){
            $items = $items->where('name', 'like', '%' . request('name') . '%');
        }
        $items = $items->where('country_id',$id)->latest()->paginate(15);
        return view('admin.city.index',compact('items','id','cat'));
    }

    public function create(){
        $id=\request('id');
        return view('admin.city.create',compact('id'));

    }

    public function store(Request $request)
    {
        $validator =Validator::make(request()->all(),[
            'name' => 'required|string|max:500',
        ]);
        $niceNames = [
            'name' => 'اسم المدينة',
        ];
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()){
            $err=$validator->errors()->first();
            return r_backerror($err);
        }
        $input= $request->all();
        if($request->hasFile('img')){
            $input['img'] = img_thum($request,'img',540,379);

        }
        $new=City::create($input);
        return r_reditrect('city.index',['id'=>$new->country_id]);
    }

    public function edit($id)
    {
        $item=City::find($id);
        return view('admin.city.edit',compact('item'));

    }

    public function update(Request $request,$id)
    {
        $validator =Validator::make(request()->all(),[
            'name' => 'required|string|max:255',
        ]);
        $niceNames = [
            'name' => 'اسم المدينة',
        ];
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()){
            $err=$validator->errors()->first();
            return r_backerror($err);
        }
        $input= $request->all();
        if($request->hasFile('img')){
            $input['img'] = img_thum($request,'img',540,379);
        }else{
            $input = Arr::except($input,array('img'));
        }
        $new = City::find($id);
        $new->update($input);
        $new->save();
        return r_reditrect('city.index',['id'=>$new->country_id]);

    }

    public function destroy($id)
    {
        $item=City::find($id);
        if(isset($item)){
            City::destroy($id);
        }
        return r_back();
    }

    public function country_id(){
        $id=request('country_id');
        $cities=City::where('country_id',$id)->get();
        $view=view('admin.city.city',compact('cities'))->render();
        return apisuccess($view);
    }
}
