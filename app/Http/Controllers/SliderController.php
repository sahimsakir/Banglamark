<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Slider;
use App\Models\Division;
use App\Models\SubDivision;
use App\Models\Page;
use Illuminate\Support\Str;
use App\Services\FileUpload;

class SliderController extends Controller
{
    

    public function index(Request $r, Slider $rows){
        
        $rows = $rows->newQuery();
        
        if($r->type){
            $rows = $rows->where('type',$r->type);
        }
        
        $pg = 30;
        $p = ($r->input('page',1)-1 ) * $pg;
        
        //===
        $user = auth()->user();
        $divs = $user->getMyDivs();
        $subs = $user->getMySubDivs();
       

      
          $rows = $rows->orderBy('id')->paginate($pg);
        
        foreach($rows as $k => $item){
 
            if($item->type=='Division' && !in_array($item->parent_id,$divs)){
                $rows->forget($k);
               
            }
            
            if($item->type=='Sub-division' && !in_array($item->parent_id,$subs)){
                $rows->forget($k);
               
            }
            
            if($item->type=='Page' && auth()->user()->role !='Admin'){
                $rows->forget($k);
               
            }
                
                
            
        }
        
      
        
        
    	return view('admin.slider.index',compact('rows','p'));

    }
    
    public function get_type(Request $r){
        
        $type = $r->type;
        $rows = null;
        $opt= '';
        
        if($type=='Division'){
            
            $rows = Division::myDivs()->orderBy('name')->get();
            
             foreach($rows as $row){
            
                $opt.='<option value="'.$row->id.'">'.$row->name.'</option>';
            }
            
        }elseif($type=='Sub-division'){
            
            $rows = SubDivision::mySubDivs()->with(['division'])->orderBy('division_id')->orderBy('name')->get();
             
            foreach($rows as $row){
            
                $opt.='<option value="'.$row->id.'">'.$row->division->name.' - '.$row->name.'</option>';
            }
        
            
        }elseif($type=='Page'){
            
            if(auth()->user()->role!='Admin'){
               
               return false; 
            }
            
            $rows = Page::orderBy('title')->get();
            
            foreach($rows as $row){
            
                $opt.='<option value="'.$row->id.'">'.$row->title.'</option>';
            }
        }
        
     
        
       
        
        return $opt;
        
    }

    public function store(Request $r){
        
        $this->validate($r,[
            'parent_id'=>'required',
            'title'=>'required',
            'img'=>'required',
            'type'=>'required',
            ]);
        
        $row = new Slider;
        $row->parent_id = $r->parent_id;
        $row->type = $r->type;
        $row->title = $r->title;

        if($r->img){
            
            $fileup = new FileUpload;
            $file = $fileup->upload($r->img);
            $row->img = $file;
        }
        
        if($row->save()){
            
            return back()->with('success','Slider added');
        }

    }
    
   
    
    public function destroy($id){
        
        $row = Slider::FindOrFail($id);
        
        $fileup = new FileUpload;
        
        $fileup->del_file($row->img);
        
        $row->delete();
        
        return back()->with('success','Slider removed');
    }

  
}
