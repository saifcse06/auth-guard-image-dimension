<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class Admin extends Authenticatable
{
    use Notifiable;
    const TYPE_SYSTEM='System';
    const TYPE_ADMIN='Admin';
    const TYPE_MANAGER='Manager';


    protected $fillable = ['name', 'email','admin_type', 'password'];

    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * boot function for created by and updated by
     * */
    public static function boot(){
        parent::boot();
        static::creating(function($query){
            if(Auth::check()){
                $query->created_by = Auth::user()->id;
            }
        });
        static::updating(function($query){
            if(Auth::check()){
                $query->updated_by = Auth::user()->id;
            }
        });
    }
}
