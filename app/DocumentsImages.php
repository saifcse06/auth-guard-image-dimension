<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DocumentsImages extends Model
{
    protected $fillable = [
        'title','file_path','file_data','file_type'
    ];
    const FILE_IMAGE = 'Image';
    const FILE_DOC = 'Doc';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
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
