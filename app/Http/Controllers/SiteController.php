<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Page;
use App\Models\Division;
use App\Models\SubDivision;
use App\Models\Service;
use App\Models\Product;
use App\Models\Partner;
use App\Models\Slider;
use App\Models\Video;
use App\Models\Download;

class SiteController extends Controller
{
    

    public function index(){
        
        $divisions = Division::orderBy('sort')->get();
        
        $slides = Slider::inRandomOrder()->take(5)->get();

    	return view('site.index',compact('divisions','slides'));

    }
    

    public function division($division){
        
        //contact
        
        if($division=='contact'){
            
            return view('site.contact');
        }
            
        $page = Page::where('slug',$division)->first();
                
            if($page){
                
                $data = $page;
                $slides = Slider::where('type','page')
                                ->where('parent_id',$page->id)->take(5)->get();
                $partners = Partner::take(10)->get();
                
                return view('site.page',compact('data','partners','slides'));
            }
       
        
        $data = Division::whereSlug($division)->with(['subdivisions'=>function($qry){
            $qry->orderBy('sort');
        }])->firstOrFail();
        
        $sub_divs = SubDivision::where('division_id',$data->id)->pluck('id')->all();
        
        $partners = Partner::whereIn('sub_div_id',$sub_divs)->get();
        
        $slides = Slider::where('type','Division')->where('parent_id',$data->id)->take(5)->get();
        
        $videos = Video::whereIn('sub_div_id',$sub_divs)->get();
        $downloads = Download::whereIn('sub_div_id',$sub_divs)->get();
        
        return view('site.division',compact('data','partners','slides','videos','downloads'));


    }
    
    public function sub_div($div,$sub_div){
        
        $div = Division::whereSlug($div)->firstOrFail();
        
        $data = SubDivision::whereSlug($sub_div)->with(['division','services.products'])->firstOrFail();
        
        $services = Service::where('sub_div_id',$data->id)->orderBy('sort')->get();
        
       
        $partners = Partner::where('sub_div_id',$data->id)->get();
        
        $slides = Slider::where('type','Sub-division')->where('parent_id',$data->id)->take(5)->get();
        $videos = Video::where('sub_div_id',$data->id)->get();
        $downloads = Download::where('sub_div_id',$data->id)->get();
        
        return view('site.sub_division',compact('data','services','partners','slides','videos','downloads'));
    }
    
    public function product($div,$sub_div,$id){
        
        $row = Product::find($id);
        
        return view('site.product',compact('row'));
    }
    
  
}
