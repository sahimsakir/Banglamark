<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Page;
use App\Models\Division;
use App\Models\SubDivision;
use App\Models\Service;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Services\FileUpload;

class DivisionController extends Controller
{
    

    public function index(Request $r){
        
        
        
        $pg = 20;
        $p = ($r->input('page',1)-1 ) * $pg;
        
        $rows = Division::mydivs()->withCount('subdivisions')->orderBy('sort')->paginate($pg);


    	return view('admin.division.index',compact('rows','p'));

    }

    public function store(Request $r){
        
        $row = new Division;
        $row->name = $r->name;
        $row->slug = Str::slug($r->name, '-');
        
        if($row->save()){
            
            return redirect()->route('divisions.edit',$row->id);
        }

    }
    
    public function edit($id){
        
        $row = Division::mydivs()->findOrFail($id);
        
        return view('admin.division.edit',compact('row'));
        
    }
    
    public function update(Request $r,$id){
        
        $this->validate($r,[
            'slug'=>'unique:divisions,slug,'.$id,
            ]);
        
        $row = Division::mydivs()->findOrFail($id);
        
        $row->name = $r->name;
        $row->slug = $r->slug;
        $row->meta_title = $r->meta_title;
        $row->meta_des = $r->meta_des;
        $row->meta_kw = $r->meta_kw;
        $row->intro = $r->intro;
        $row->sort = $r->sort;
        $row->address = $r->address;
        $row->phone1 = $r->phone1;
        $row->phone2 = $r->phone2;
        $row->email1 = $r->email1;
        $row->email2 = $r->email2;
        
        if($r->img){
            
            $fileup = new FileUpload;
            $new_file = $fileup->setFileName('division')->upload($r->img);
            
              // remove old
            $fileup->del_file($row->img);
            
            $row->img = $new_file;
            
          
            
        }
        
        if($r->remove_file){
            $fileup = new FileUpload;
            $fileup->del_file($row->img);
            $row->img = null;
        }
       
        
        if($row->save()){
            return redirect()->route('divisions.index')->with('success','Record updated');
        }
    }
    
    public function destroy($id){
        
        $row = Division::mydivs()->findOrFail($id);
        
        if($row->subdivisions()->count() > 0 ){
            
            return back()->with('danger','Division has sub divisions.');
        }
        
        // delete img
        $fileup = new FileUpload;
        $fileup->del_file($row->img);
        
        if($row->delete()){
            
            return back()->with('success','Division removed');
        }
    }

  
}
