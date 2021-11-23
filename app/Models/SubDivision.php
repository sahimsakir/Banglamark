<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class SubDivision extends Model
{
    use HasFactory;

    protected $table ='sub_divisions';
    
    public $timestamps = false;
    
    
    public function division(){
        
        return $this->belongsTo('App\Models\Division','division_id','id')->withDefault();
    }
    
    public function services(){
        
         return $this->hasMany('App\Models\Service','sub_div_id','id');
    }
    
    public function scopeMySubDivs($qry){
        $user = auth()->user();
        $arr = $user->getMyDivs();
      
        return $qry->whereIn('division_id',$arr);
    }
    

    

    
}