<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdvertismentImage extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
         'img','adv_id'
    ];

    public function adv(){
        return $this->belongsTo(Advertisment::class,'adv_id');
    }
}
