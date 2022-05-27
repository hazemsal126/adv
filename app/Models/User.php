<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable,SoftDeletes,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email','address',
        'password','phone','whatsapp','facebook','img','isadmin','type','is_terms','fcm','website','postal_code','twitter',
        'instagram','snapshat','telegram','state','birthday','country_id','city_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rule($id=null){
        return [
            'name' => 'required',
            'email' => 'required|string|email|confirmed|max:255|unique:users,email,'.$id,
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ];
    }

    public function rule_u($id=null){
        return [
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,

        ];
    }



}
