<?php
namespace App\Services;

use App\Models\Division;
use App\Models\SubDivision;
use App\Models\Service;
use App\Models\Product;


trait DivTrait{
    
    public function getMyDivs(){
        
        $user = auth()->user();

        $mydivs = [];
        
        if($user->divisions){
           $mydivs = explode(',',$user->divisions); 
        } 
        
        return $mydivs;
    }
    
    public function getMySubDivs(){
        
        $divs = $this->getMyDivs();
        
        $subs = SubDivision::whereIn('division_id',$divs)->pluck('id')->all();
        
        return $subs;
        
    }
    
     public function getMyServices(){

        $subs = $this->getMySubDivs();
        
        $services = Service::whereIn('sub_div_id',$subs)->pluck('id')->all();
        
        return $services;
        
    }
    
     public function getMyProducts(){

        $srvs = $this->getMyServices();
        
        $products = Product::whereIn('service_id',$srvs)->pluck('id')->all();
        
        return $products;
        
    }
    
}