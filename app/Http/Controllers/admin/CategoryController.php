<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
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
        $items = new Category();
        if(request('name')){
            $items = $items->where('name', 'like', '%' . request('name') . '%');
        }
        $items = $items->latest()->paginate(15);
        return view('admin.category.index',compact('items'));
    }

    public function create(){
        return view('admin.category.create');

    }

    public function store(Request $request)
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
        }
        $new=Category::create($input);
        return r_reditrect('category.index');
    }

    public function edit($id)
    {
        $item=Category::find($id);
        return view('admin.category.edit',compact('item'));

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
        $new = Category::find($id);
        $new->update($input);
        $new->save();
        return r_reditrect('category.index');

    }

    public function destroy($id)
    {
        $item=Category::find($id);
        if(isset($item)){
            if(count($item->sub()->get()) > 0){
                $item->sub()->delete();
            }
            Category::destroy($id);
        }
        return r_back();
    }
}
