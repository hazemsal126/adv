<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
         'name','img','cat_id'
    ];

    public function cat(){
        return $this->belongsTo(Category::class,'cat_id');
    }
}
