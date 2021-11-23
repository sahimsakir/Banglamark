<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Download;
use App\Models\SubDivision;
use Illuminate\Support\Str;
use App\Services\FileUpload;

class DownloadController extends Controller
{
    

    public function index(Request $r, Download $rows){
        
        $rows = $rows->newQuery();
        
        
        if($r->sub_div_id){
            $rows = $rows->where('sub_div_id',$r->sub_div_id);
        }
        
        $pg = 20;
        $p = ($r->input('page',1)-1 ) * $pg;
        $mysubs =  SubDivision::mySubDivs()->pluck('id')->all();
        
        $rows = $rows->whereIn('sub_div_id',$mysubs)->with(['subdivision'])->orderBy('id')->paginate($pg);
        $subdivisions = SubDivision::mySubDivs()->with('division')->orderBy('division_id')->get();
        
     
        
    	return view('admin.download.index',compact('rows','p','subdivisions'));

    }

    public function store(Request $r){
        
        $this->validate($r,[
            'sub_div_id'=>'required',
            'title'=>'required',
            'file'=>'required'
            ]);
        
        $row = new Download;
        $row->sub_div_id = $r->sub_div_id;
        $row->title = $r->title;
        $row->sort = 1;
       
        if($r->file){
            
            $fileup = new FileUpload;
            $file = $fileup->upload($r->file);
            $row->file = $file;
        }
        
        if($row->save()){
            
            return back()->with('success','File added');
        }

    }
    
    public function update(Request $r,$id){
        
        $row = Download::findOrFail($id);
        
         $this->validate($r,[
            'sub_div_id'=>'required',
            'title'=>'required'
     
            ]);
         
        $row->sub_div_id = $r->sub_div_id;
        $row->title = $r->title;
        $row->sort = $r->sort;
       
        if($r->file){
          $old = $row->file;
            
            $fileup = new FileUpload;
            $file = $fileup->upload($r->file);
            $row->file = $file;
            
            // remove old
            $fileup->del_file($old);
            
        }
        
         if($row->save()){
            
            return back()->with('success','File updated');
        }

        
        
        
        
    }
    
   
    
    public function destroy($id){
        
        $row = Download::findOrFail($id);
        
        $fileup = new FileUpload;
        
        $fileup->del_file($row->file);
        
        $row->delete();
        
        return back()->with('success','File removed');
    }

  
}
