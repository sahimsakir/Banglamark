<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;

    protected $table ='products';
    
    public $timestamps = false;
    
    
   public function service(){
       
       return $this->belongsTo('App\Models\Service','service_id','id')->withDefault();
       
   }
   
  public function scopeMyProducts($qry){
        $user = auth()->user();
        $arr = $user->getMyServices();
      
        return $qry->whereIn('service_id',$arr);
    }
    
}