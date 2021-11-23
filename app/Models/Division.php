<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $table ='divisions';
    
    public $timestamps = false;
    
    
    public function subdivisions(){
        
        return $this->hasMany('App\Models\SubDivision','division_id','id');
    }
    
    public function scopeMydivs($qry){
        $user = auth()->user();
        $mydivs = $user->getMyDivs();
      
        return $qry->whereIn('id',$mydivs );
    }
    
    

    
}