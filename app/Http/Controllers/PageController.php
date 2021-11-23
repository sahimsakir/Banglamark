<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Page;
use Illuminate\Support\Str;
use App\Services\FileUpload;

class PageController extends Controller
{
    

    public function index(Request $r, Page $rows){
        
        $rows = $rows->newQuery();
      
        $pg = 12;
        $p = ($r->input('page',1)-1 ) * $pg;
        
        $rows = $rows->orderBy('id')->paginate($pg);
        
    	return view('admin.page.index',compact('rows','p'));

    }
    

    public function store(Request $r){
        
        $this->validate($r,[
   
            'title'=>'required'

            ]);
        
        $row = new Page;
        $row->title = $r->title;
        $row->slug = Str::slug($r->title,'-');
        
        if($row->save()){
            
            return redirect()->route('pages.edit',$row->id);
        }

    }
    
    public function edit($id){
        
        $row = Page::findOrFail($id);
        
        return view('admin.page.edit',compact('row'));
    }
    
    public function update(Request $r, $id){
        
        $row = Page::findOrFail($id);
        
        $this->validate($r,[
   
            'title'=>'required',
            'slug' =>'required|unique:pages,slug,'.$row->id

            ]);
        
        $row->title = $r->title;
        $row->slug = $r->slug;
        $row->body = $r->body;
        $row->meta_title = $r->meta_title;
        $row->meta_des = $r->meta_des;
        $row->meta_kw = $r->meta_kw;
        $row->sort = $r->sort;
        $row->status = $r->status;
        
        if($row->save()){
            
            return back()->with('success','Page updated');
        }
        
        
        
    }
    
   
    
    public function destroy($id){
        
        $row = Page::findOrFail($id);
        
        $row->delete();
        
        return back()->with('success','Page removed');
    }

  
}
