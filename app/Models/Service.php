<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Service extends Model
{
    use HasFactory;

    protected $table ='services';
    
    public $timestamps = false;
    
   public function products(){
       
       return $this->hasMany('App\Models\Product','service_id','id');
   }
   
   // to be off
    public function subServices(){
       
       return $this->hasMany('App\Models\SubService','service_id','id');
   }
   
    public function subs(){
       
       return $this->hasMany('App\Models\Service','parent_id','id');
   }
   
   public function pservice(){
       
       return $this->belongsTo('App\Models\Service','parent_id','id')->withDefault();
   }
   
   
   public function subdivision(){
       
       return $this->belongsTo('App\Models\SubDivision','sub_div_id','id')->withDefault();
   }
    
  
    public function scopeMyServices($qry){
        $user = auth()->user();
        $arr = $user->getMySubDivs();
      
        return $qry->whereIn('sub_div_id',$arr);
    }
    
   
 
    
}