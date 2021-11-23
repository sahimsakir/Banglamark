<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $table ='partners';
    
    public $timestamps = false;
    
    public function subdivision(){
        
        return $this->belongsTo('App\Models\SubDivision','sub_div_id','id')->withDefault();
    }
    
    public function scopeMyPartners($qry){
        $user = auth()->user();
        $arr = $user->getMySubDivs();
      
        return $qry->whereIn('sub_div_id',$arr);
    }
    
}