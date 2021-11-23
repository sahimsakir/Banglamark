<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Division;
use App\Models\SubDivision;
use Illuminate\Support\Str;
use App\Services\FileUpload;

class SubDivisionController extends Controller
{
    

    public function index(Request $r, SubDivision $rows){
        
     
        $rows = $rows->newQuery();
        
        if($r->division_id){
            $rows = $rows->where('division_id',$r->division_id);
        }
        
        $pg = 20;
        $p = ($r->input('page',1)-1 ) * $pg;
        
        $rows = $rows->mySubDivs()->with(['division'])->withCount('services')->orderBy('sort')->paginate($pg);


    	return view('admin.sub_division.index',compact('rows','p'));

    }

    public function store(Request $r){
        
        $this->validate($r,[
            'division_id'=>'required',
            'name'=>'required',
            ]);
        
        $row = new SubDivision;
        $row->division_id = $r->division_id;
        $row->name = $r->name;
        $row->slug = Str::slug($r->name, '-');
        
        if($row->save()){
            
            return redirect()->route('sub-divisions.edit',$row->id);
        }

    }
    
    public function edit($id){
        
        $row = SubDivision::mySubDivs()->findOrFail($id);
        
        $divisions = Division::all();
        
        return view('admin.sub_division.edit',compact('row','divisions'));
        
    }
    
    public function update(Request $r,$id){
        
        $this->validate($r,[
            'slug'=>'unique:sub_divisions,slug,'.$id,
            'name'=>'required'
            ]);
        
        $row = SubDivision::mySubDivs()->findOrFail($id);
        

        $row->name = $r->name;
        $row->slug = $r->slug;
        $row->meta_title = $r->meta_title;
        $row->meta_des = $r->meta_des;
        $row->meta_kw = $r->meta_kw;
        $row->short_intro = $r->short_intro;
        $row->intro = $r->intro;
        $row->sort = $r->sort;
        $row->address = $r->address;
        $row->phone1 = $r->phone1;
        $row->phone2 = $r->phone2;
        $row->email1 = $r->email1;
        $row->email2 = $r->email2;
        
        if($r->img){
            
            $fileup = new FileUpload;
            $new_file = $fileup->setFileName($r->slug)->upload($r->img);
            
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
            return redirect()->route('sub-divisions.index',['division_id'=>$row->division_id])->with('success','Record updated');
        }
    }
    
    public function destroy($id){
        
        $row = SubDivision::mySubDivs()->findOrFail($id);
        
        if($row->services()->count() > 0 ){
            
            return back()->with('danger','Sub Division has services');
        }
        
        // delete img
        $fileup = new FileUpload;
        $fileup->del_file($row->img);
        
        if($row->delete()){
            
            return back()->with('success','Sub Division removed');
        }
    }

  
}
