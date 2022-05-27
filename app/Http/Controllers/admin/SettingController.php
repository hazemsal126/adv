<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    //

    public function index(){
        $item=Setting::first();
        return view('admin.setting.edit',compact('item'));
    }

    public function update(Request $request)
    {
        $validator =Validator::make(request()->all(),[
            'facebook' => 'required',
            'instagram' => 'required',
            'whatsapp' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'footter' => 'required',
            'snapchat' => 'required',
        ]);
        $niceNames = [
            'facebook' => ' الفيس بوك',
            'instagram' => 'الانستغرام ',
            'whatsapp' => ' الواتس اب',
            'email' => ' الايميل',
            'phone' => 'رقم الهاتف ',
            'footter' => 'نص الفوتر ',
            'snapchat' => 'السناب شات ',

        ];
        $validator->setAttributeNames($niceNames);
        if ($validator->fails()){
            $err=$validator->errors()->first();
            return r_backerror($err);
        }
        $input= $request->all();
        if($request->hasFile('logo')){
            $input['logo'] = img_thum($request,'logo',160,15);

        }else{
            $input = Arr::except($input,array('logo'));
        }
        if($request->hasFile('favicon')){
            $input['favicon'] = upload($request,'favicon')['file'];
        }
        $new = Setting::first();
        $new->update($input);
        $new->save();
        return r_back();

    }

}
