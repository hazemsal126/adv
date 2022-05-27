<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

class FaqController extends Controller
{
    //


    function __construct()
    {
        $this->middleware('permission:faq-list|faq-create|faq-edit|faq-destroy', ['only' => ['index','store']]);
        $this->middleware('permission:faq-create', ['only' => ['create','store']]);
        $this->middleware('permission:faq-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:faq-destroy', ['only' => ['destroy']]);
    }
    //
    public function index(){
        $items = new Faq();
        if(request('title')){
            $items = $items->where('title', 'like', '%' . request('title') . '%');
        }
        $items = $items->latest()->paginate(15)->appends(request()->query());
        return view('admin.faq.index',compact('items'));
    }

    public function create(){
        return view('admin.faq.create');

    }

    public function store(Request $request)
    {
        $validator =Validator::make(request()->all(),[
            'title' => 'required|string|max:255',
            'content' => 'required',
            'img'=>'required',
        ]);
        $niceNames = [
            'title' => 'العنوان',
            'content' => 'المحتوى',
            'img'=>'الصورة',

        ];
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()){
            $err=$validator->errors()->first();
            return r_backerror($err);
        }
        $input= $request->all();
        if($request->hasFile('img')){
            $input['img'] = img_thum($request,'img',540,290);
        }
        $new=Faq::create($input);
        return r_back();
    }

    public function edit($id)
    {
        $item=Faq::find($id);
        return view('admin.faq.edit',compact('item'));

    }

    public function update(Request $request,$id)
    {
        $validator =Validator::make(request()->all(),[
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);
        $niceNames = [
            'title' => 'العنوان',
            'content' => 'المحتوى',
        ];
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()){
            $err=$validator->errors()->first();
            return r_backerror($err);
        }
        $input= $request->all();
        if($request->hasFile('img')){
            $input['img'] = img_thum($request,'img',540,290);
        }else{
            $input = Arr::except($input,array('img'));
        }
        $new = Faq::find($id);
        $new->update($input);
        $new->save();
        return r_back();

    }

    public function destroy($id)
    {
        $item=Faq::find($id);
        if(isset($item)){
            Faq::destroy($id);
        }
        return r_back();
    }
}
