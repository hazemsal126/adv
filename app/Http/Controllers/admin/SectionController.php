<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class SectionController extends Controller
{
    //

    function __construct()
    {
        $this->middleware('permission:setting-edit', ['only' => ['index']]);
        $this->middleware('permission:setting-edit', ['only' => ['edit','update']]);
    }
    //
    public function index(){
        $items = new Section();
        if(request('title')){
            $items = $items->where('title', 'like', '%' . request('title') . '%');
        }
        $items = $items->latest()->paginate(15);
        return view('admin.section.index',compact('items'));
    }

    public function edit($id)
    {
        $item=Section::find($id);
        switch ($id){
            case 1:
                $title='سياسة الخصوصية';
        return view('admin.setting.section',compact('item','title'));
        break;

        case 2 :
            $title='من نحن';
            return view('admin.setting.section',compact('item','title'));
            break;

        case 3 :
            $title='الشروط والأحكام';
            return view('admin.setting.section',compact('item','title'));
            break;

            default:
        return view('admin.section.edit',compact('item'));



        }

    }

    public function update(Request $request,$id)
    {
        $validator =Validator::make(request()->all(),[
            'title' => 'required|string|max:255',
        ]);
        $niceNames = [
            'title' => ' العنوان',
        ];
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()){
            $err=$validator->errors()->first();
            return r_backerror($err);
        }
        $input= $request->all();
        if($request->hasFile('img')){
            $input['img'] = img_thum($request,'img',445,426);

        }else{
            $input = Arr::except($input,array('img'));
        }
        $new = Section::find($id);
        $new->update($input);
        $new->save();
        return r_back();
    }
}
