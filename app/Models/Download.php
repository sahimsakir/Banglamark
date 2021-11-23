<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    use HasFactory;

    protected $table ='downloads';
    
    public $timestamps = false;
    
    
    public function subdivision(){
        return $this->belongsTo('App\Models\SubDivision','sub_div_id','id')->withDefault();
    }

    
}