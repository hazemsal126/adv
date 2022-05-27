<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    //

    function __construct()
    {
        $this->middleware('permission:category-list|category-create|category-edit|category-destroy', ['only' => ['index','store']]);
        $this->middleware('permission:category-create', ['only' => ['create','store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:category-destroy', ['only' => ['destroy']]);
    }
    //
    public function index(){
        $id=\request('id');
        $cat=Category::find($id);
        $items = new SubCategory();
        if(request('name')){
            $items = $items->where('name', 'like', '%' . request('name') . '%');
        }
        $items = $items->where('cat_id',$id)->latest()->paginate(15);
        return view('admin.subcategory.index',compact('items','id','cat'));
    }

    public function create(){
        $id=\request('id');
        return view('admin.subcategory.create',compact('id'));

    }

    public function store(Request $request)
    {
        $validator =Validator::make(request()->all(),[
            'name' => 'required|string|max:500',
        ]);
        $niceNames = [
            'name' => 'اسم القسم',
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
        $new=SubCategory::create($input);
        return r_reditrect('sub_category.index',['id'=>$new->cat_id]);
    }

    public function edit($id)
    {
        $item=SubCategory::find($id);
        return view('admin.subcategory.edit',compact('item'));

    }

    public function update(Request $request,$id)
    {
        $validator =Validator::make(request()->all(),[
            'name' => 'required|string|max:255',
        ]);
        $niceNames = [
            'name' => 'اسم القسم',
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
        $new = SubCategory::find($id);
        $new->update($input);
        $new->save();
        return r_reditrect('sub_category.index',['id'=>$new->cat_id]);

    }

    public function destroy($id)
    {
        $item=SubCategory::find($id);
        if(isset($item)){
            SubCategory::destroy($id);
        }
        return r_back();
    }

    public function cat_id(){
        $id=request('cat_id');
        $subcats=SubCategory::where('cat_id',$id)->get();
        $view=view('admin.subcategory.subcat',compact('subcats'))->render();
        return apisuccess($view);
    }
}
