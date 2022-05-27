<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisment;
use App\Models\AdvertismentImage;
use App\Models\Category;
use App\Models\sUBCategory;
use App\Models\Country;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class AdvController extends Controller
{
    //

    function __construct()
    {
        $this->middleware('permission:advertisment-list|advertisment-create|advertisment-edit|advertisment-destroy', ['only' => ['index','store']]);
        $this->middleware('permission:advertisment-create', ['only' => ['create','store']]);
        $this->middleware('permission:advertisment-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:advertisment-destroy', ['only' => ['destroy']]);
    }
    //
    public function index(){
        $items = new Advertisment();
        if(request('title')){
            $items = $items->where('title', 'like', '%' . request('title') . '%');
        }
        if(request('country_id')){
            $items = $items->where('country_id', request('country_id') );
            $cities=City::where('country_id',request('country_id'))->get();
        }
        else{
            $cities=null;
        }
        if(request('city_id')){
            $items = $items->where('city_id', request('city_id') );
        }
        if(request('cat_id')){
            $items = $items->where('cat_id', request('cat_id') );
            $subcats=SubCategory::where('cat_id',request('cat_id'))->get();

        }
        else{
            $subcats=null;
        }
        if(request('subcat_id')){
            $items = $items->where('subcat_id', request('subcat_id') );
        }
        $items = $items->latest()->paginate(15);
        $cats=Category::pluck('name','id')->toArray();
        $countries=Country::pluck('name','id')->toArray();
        return view('admin.advertisment.index',compact('items','cats','countries','cities','subcats'));
    }

    public function create(){
        $cats=Category::pluck('name','id')->toArray();
        $countries=Country::pluck('name','id')->toArray();
        return view('admin.advertisment.create',compact('cats','countries'));

    }

    public function store(Request $request)
    {
        $validator =Validator::make(request()->all(),[
            'title' => 'required|string|max:255',
            'price' => 'required',
            'cat_id' => 'required',
            'subcat_id' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'images.*' => 'required|mimes:jpg,jpeg,png,bmp,tiff |max:4096',
            'img' => 'required|mimes:jpg,jpeg,png,bmp,tiff |max:4096',
        ]);
        $niceNames = [
            'title' => 'عنوان الاعلان',
            'price' => 'السعر',
            'cat_id' => 'القسم',
            'subcat_id' => 'القسم الفرعي',
            'country_id' => 'الدولة',
            'city_id' => 'المدينة',
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


        $input['user_id'] = authid()->id;
        $new=Advertisment::create($input);

        if($request->hasFile('images')){
            $images=$request->file('images');
            foreach($images as $img){
                $image=img_thum_multi($img,'img',540,379);
                $new_img=new AdvertismentImage();
                $new_img->img=$image;
                $new_img->adv_id=$new->id;
                $new_img->save();
            }


        }
        return r_reditrect('advertisment.index');
    }

    public function edit($id)
    {
        $item=Advertisment::find($id);
        return view('admin.advertisment.edit',compact('item'));

    }

    public function update(Request $request,$id)
    {
        $validator =Validator::make(request()->all(),[
            'title' => 'required|string|max:255',
            'price' => 'required',
            'cat_id' => 'required',
            'subcat_id' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
        ]);
        $niceNames = [
            'title' => 'عنوان الاعلان',
            'price' => 'السعر',
            'cat_id' => 'القسم',
            'subcat_id' => 'القسم الفرعي',
            'country_id' => 'الدولة',
            'city_id' => 'المدينة',
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
        $new = Advertisment::find($id);
        $new->update($input);
        $new->save();
        return r_reditrect('advertisment.index');

    }

    public function destroy($id)
    {
        $item=Advertisment::find($id);
        if(isset($item)){
            if(count($item->images()->get()) > 0){
                $item->images()->delete();
            }
            Advertisment::destroy($id);
        }
        return r_back();
    }
}
