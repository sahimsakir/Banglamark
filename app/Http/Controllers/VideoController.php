<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Video;
use App\Models\SubDivision;
use Illuminate\Support\Str;
use App\Services\FileUpload;

class VideoController extends Controller
{
    

    public function index(Request $r, Video $rows){
        
        $rows = $rows->newQuery();
        
        
        if($r->sub_div_id){
            $rows = $rows->where('sub_div_id',$r->sub_div_id);
        }
        
        $pg = 20;
        $p = ($r->input('page',1)-1 ) * $pg;
        $mysubs =  SubDivision::mySubDivs()->pluck('id')->all();
        
        $rows = $rows->whereIn('sub_div_id',$mysubs)->with(['subdivision'])->orderBy('id')->paginate($pg);
        $subdivisions = SubDivision::mySubDivs()->with('division')->orderBy('division_id')->get();
        
     
        
    	return view('admin.video.index',compact('rows','p','subdivisions'));

    }

    public function store(Request $r){
        
        $this->validate($r,[
            'sub_div_id'=>'required',
            'title'=>'required',
            'img'=>'required'
            ]);
        
        $row = new Video;
        $row->sub_div_id = $r->sub_div_id;
        $row->title = $r->title;
        $row->yt_link = $r->yt_link;
        $row->sort = 1;
       
        if($r->img){
            
            $fileup = new FileUpload;
            $file = $fileup->upload($r->img);
            $row->img = $file;
        }
        
        if($row->save()){
            
            return back()->with('success','Video added');
        }

    }
    
    public function update(Request $r,$id){
        
        $row = Video::findOrFail($id);
        
         $this->validate($r,[
            'sub_div_id'=>'required',
            'title'=>'required'
     
            ]);
         
        $row->sub_div_id = $r->sub_div_id;
        $row->title = $r->title;
        $row->yt_link = $r->yt_link;
        $row->sort = $r->sort;
       
        if($r->img){
          $old = $row->img;
            
            $fileup = new FileUpload;
            $file = $fileup->upload($r->img);
            $row->img = $file;
            
            // remove old
            $fileup->del_file($old);
            
        }
        
         if($row->save()){
            
            return back()->with('success','Video updated');
        }

        
        
        
        
    }
    
   
    
    public function destroy($id){
        
        $row = Video::findOrFail($id);
        
        $fileup = new FileUpload;
        
        $fileup->del_file($row->img);
        
        $row->delete();
        
        return back()->with('success','Video removed');
    }

  
}
