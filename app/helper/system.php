<?php

use App\AdminLog;
use App\Mail\verifymail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

function days(){
    return ['Friday','Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday'];
}

function whatday($date){
    $d=new \DateTime($date);
    return $d->format('l');
}

function catshow($id){
    $user=authid();
    if ($user->can('maintask-list') || $user->id == 1 || $user->cat_id == $id){
        return true;
    }
    else {
        return false;
    }
}

function color(){
    return['purple','red','blue','green','yellow','purple','red','blue','green','yellow',
        'purple','red','blue','green','yellow','purple','red','blue','green','yellow',];
}

function date_report(){
    $y=date('y');
    $m=date('m');
    $d=date('d');
    $it=\App\GroubReport::where([['year',$y],['month',$m],['from','<=',$d],['to','<=',31]])->orwhere([['year',$y],['month',$m],['from','>=',1],['to','>=',$d]])->first();
    if (isset($it)){
        return $it->id;
    }
    else{
        $new=new \App\GroubReport();
        $new->year = $y;
        $new->month = $m;
        $new->from = 19;
        $new->to = 20;
        $new->save();
        return $new->id;
    }
}

function notify($modal,$modal_id,$url,$receiver_id,$msg,$title=null){
    $notification=array(
        "body"=>$msg,
        "title"=>$title,
    );

    $messaging = app('firebase.messaging');
    if (isset($receiver_id[0]))
    foreach ($receiver_id as $rr) {
        $notify = new \App\Models\Notification();
        $notify->modal = $modal;
        $notify->modal_id = $modal_id;
        $notify->url = $url;
        $notify->user_id=$rr->id;
        $notify->msg=$msg;
        $notify->title=$title;
        $notify->save();
        $data=array(
            'from_u' => $modal_id,
            'to_u' => $rr->id,
    );
        $message = \Kreait\Firebase\Messaging\CloudMessage::withTarget('token', $rr->fcm ? $rr->fcm:'-')
            ->withNotification($notification)->withData($data);
        $messaging->send($message);
    }
}

function verify_mail($mail){
    $token=random_int('100000','999999');
    Mail::to($mail)->send(new verifymail($token));

    $user=authid();
    $user->token=$token;
    $user->save();
    return true;
}
function admin_log($text,$model,$model_id,$route){
    $log=new \App\AdminLog();
    $log->text=$text;
    $log->model=$model;
    $log->model_id=$model_id;
    $log->route=$route;
    $log->user_id=authid()->id;
    $log->save();
}

function downloadfile($file){
    if(file_exists($file)) {
        return response()->download($file);
    }
}

function dfile($path){
    if(file_exists($path)){
        unlink($path);
    }
}

function img(Request $request,$type){
    if ($request->hasFile($type)) {
        $image = $request->file($type);
        $photo = time().'_'.random_int(1111,9999).'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/upload/img/');
        $image->move($destinationPath, $photo);
        return $photo;
    }
}

function img_thum(Request $request,$type,$w,$h){
    if ($request->hasFile($type)) {
        $image = $request->file($type);
        $photo = time().'_'.random_int(1111,9999).'.'.$image->getClientOriginalExtension();
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize($w,$h);
        $Path = public_path('upload/img/thum/'.$photo);
        $image_resize->save($Path);

        $destinationPath = public_path('/upload/img/');
        $image->move($destinationPath, $photo);
        return $photo;
    }
}

function img_thum_multi($image,$type,$w,$h){
        $photo = time().'_'.random_int(1111,9999).'.'.$image->getClientOriginalExtension();
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize($w,$h);
        $Path = public_path('upload/img/thum/'.$photo);
        $image_resize->save($Path);

        $destinationPath = public_path('/upload/img/');
        $image->move($destinationPath, $photo);
        return $photo;
}

function upload($image,$type){
    ini_set('memory_limit', '-1');
    ini_set('max_file_uploads','66');
        $filename=$image->getClientOriginalName();
        $filename=pathinfo($filename,PATHINFO_FILENAME);
        $file_type=$image->getClientMimeType();
        $file = time().'_'.random_int(1111,9999).'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/upload'.'/'.$type);
        $image->move($destinationPath, $file);
        $data=[
            'file'=>$file,
            'filename'=>$filename,
            'file_type'=>$file_type
        ];
        return $data;
}

function mimestype(){
    return 'mimetypes:video/mp4,video/ogg,audio/*';
}

function getfile($file,$type){
    return asset('upload/'.$type.'/' . $file);
}

function getimg($img){
    if (isset($img)) {
        return asset('upload/img/' . $img);
    }
    else
        return asset('upload/no-image.png');
}

function getimg_thum($img){
    if (isset($img)) {
        return asset('upload/img/thum/' . $img);
    }
    else
        return asset('upload/no-image.png');
}

function langview($view,$data=null){
    if(\App::isLocale('ar')){
        return view('front.ar.'.$view)->with($data);
    }
    else return view('front.en.'.$view)->with($data);
}

function lang($field)
{
    if(\App::isLocale('en')){
        if ($field.'_en' != null)
            return $field.'_en';
        else return $field;
    }
    else return $field;
}

function authid(){
    return auth()->user();
}

function c_page(){
    return 35;
}

function f_page(){
    return 16;
}

function unauth(){
    $msg = array(
        'message' => trans('front.unauth'),
        'alert-type' => 'error'
    );
    return redirect()->back()->with($msg);
}

function avgg($num){
    if ($num < 1.5){
        return 1;
    }
    elseif ($num >= 1.5 && $num < 2.5){
        return 2;
    }
    elseif ($num >=2.5 && $num < 3.5){
        return 3;
    }
    elseif ($num >= 3.5 && $num < 4.5){
        return 4;
    }
    else {
        return 5;
    }
}

function unauthjs(){
    $status = false;
    $msg = trans('api.unauth');
    return response()->json(['status' => $status, 'msg' => $msg],401);
}


function r_back(){
    $msg = array(
        'message' => trans('front.successfully'),
        'alert-type' => 'success'
    );
    return redirect()->back()->with($msg);
}

function r_reditrect($route,$args=null){
    $msg = array(
        'message' => trans('front.successfully'),
        'alert-type' => 'success'
    );
    return redirect()->route(''.$route,$args)->with($msg);
}

function r_backerror($error){
    $msg = array(
        'message' => $error,
        'alert-type' => 'error'
    );
    return redirect()->back()->with($msg)->withInput();
}

function error_back(){
    $msg = array(
        'message' => trans('front.error'),
        'alert-type' => 'error'
    );
    return redirect()->back()->with($msg);
}


function exist_product(){
    $status = false;
    $msg = 'This product has already been added';
    return response()->json(['status' => $status, 'msg' => $msg]);
}

function errorauthjs(){
    $status = false;
    $msg = trans('api.errorauth');
    return response()->json(['code'=>401,'success' => $status, 'message' => $msg,'data'=>null],401);
}

function success(){
    $status = true;
    $msg = trans('front.success');
    return response()->json(['code'=>200,'success' => $status, 'message' => $msg,'data'=>null]);
}

function unsuccess(){
    $msg=trans('front.unsuccess');
    $status = false;
    return response()->json(['code'=>401,'success' => $status, 'message' => $msg,'data'=>null],401);
}
function apiNotFound(){
    // $msg=trans('front.unsuccess');
    $status = false;
    return response()->json(['code'=>401,'success' => $status, 'message' =>"Not Found",'data'=>null],404);
}

function validation($msg){
    $status = false;
    return response()->json(['code'=>422,'success' => $status, 'message' => $msg,'data'=>null],422);
}

function notfound(){
    $status = false;
    $msg = 'No more records found';
    return response()->json(['code'=>200,'success' => $status, 'message' => $msg,'data'=>null]);
}

function apisuccess($items,$data=null){
    return response()->json(['code'=>200,'success'=>true,'message'=>'success','data'=>$items,'items'=>$data]);
}

function shareLink($media,$url, $title=null,$image=null)
{
    if($media=="facebook")
    {
        return "http://www.facebook.com/sharer.php?u=".$url;
    }
    elseif($media=="twitter")
    {
        return "http://twitter.com/share?text=".htmlentities($title)."&url=".$url;
    }
    elseif($media=="google")
    {
        return "https://plus.google.com/share?url=".$url;
    }
    elseif($media=="pinterest")
    {
        return "http://pinterest.com/pin/create/button/?url=".$url."&media=".$image;
    }
}
