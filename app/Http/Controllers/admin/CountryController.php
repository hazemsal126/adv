<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
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
        $items = new Country();
        if(request('name')){
            $items = $items->where('name', 'like', '%' . request('name') . '%');
        }
        $items = $items->latest()->paginate(15);
        return view('admin.country.index',compact('items'));
    }

    public function create(){
        return view('admin.country.create');

    }

    public function store(Request $request)
    {
        $validator =Validator::make(request()->all(),[
            'name' => 'required|string|max:255',
        ]);
        $niceNames = [
            'name' => 'اسم الدولة',
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
        $new=Country::create($input);
        return r_reditrect('country.index');
    }

    public function edit($id)
    {
        $item=Country::find($id);
        return view('admin.country.edit',compact('item'));

    }

    public function update(Request $request,$id)
    {
        $validator =Validator::make(request()->all(),[
            'name' => 'required|string|max:255',
        ]);
        $niceNames = [
            'name' => 'اسم الدولة',
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
        $new = Country::find($id);
        $new->update($input);
        $new->save();
        return r_reditrect('country.index');

    }

    public function destroy($id)
    {
        $item=Country::find($id);
        if(isset($item)){
            if(count($item->cities()->get()) > 0){
                $item->cities()->delete();
            }
            Country::destroy($id);
        }
        return r_back();
    }
}
