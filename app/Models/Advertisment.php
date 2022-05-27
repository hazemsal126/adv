<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisment extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
         'title','img','price','desc','cat_id','subcat_id','country_id','city_id','user_id','active',
         'featured','Condition','type','auth_name','auth_email','auth_phone','auth_address'
    ];


    public function images()
    {
        return $this->hasMany(AdvertismentImage::class, 'adv_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function cat(){
        return $this->belongsTo(Category::class,'cat_id');
    }

    public function subcat(){
        return $this->belongsTo(SubCategory::class,'subcat_id');
    }


    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }

}
