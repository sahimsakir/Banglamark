<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Division;
use App\Models\SubDivision;
use App\Models\Service;
use Illuminate\Support\Str;
use App\Services\FileUpload;

class ServiceController extends Controller
{
    

    public function index(Request $r, Service $rows){
        
        $rows = $rows->newQuery();
        
        if($r->sub_div_id){
            $rows = $rows->where('sub_div_id',$r->sub_div_id);
        }
        
        $pg = 20;
        $p = ($r->input('page',1)-1 ) * $pg;
        
        $rows = $rows->myServices()->with(['subdivision'])->withCount('products','subServices')->orderBy('sort')->paginate($pg);
        $sub_divisions = SubDivision::all();
        
        
    	return view('admin.service.index',compact('rows','p','sub_divisions'));

    }

    public function store(Request $r){
        
        $this->validate($r,[
            'sub_div_id'=>'required',
            'name'=>'required',
            ]);
        
        $row = new Service;
        $row->sub_div_id = $r->sub_div_id;
        $row->name = $r->name;
 
        
        if($row->save()){
            
            return redirect()->route('services.edit',$row->id);
        }

    }
    
    public function edit($id){
        
        $row = Service::myServices()->findOrFail($id);
        
        $sub_divisions = SubDivision::all();
        
        $myservices = Service::myServices()->where('sub_div_id',$row->sub_div_id)->where('parent_id',0)->with('subdivision')->get();
        
       
        return view('admin.service.edit',compact('row','sub_divisions','myservices'));
        
    }
    
    public function update(Request $r,$id){
        
        $this->validate($r,[
            'name'=>'required',
            'sub_div_id'=>'required'
            ]);
        
        $row = Service::myServices()->findOrFail($id);
        
        $row->sub_div_id = $r->sub_div_id;
        $row->name = $r->name;
        $row->intro = $r->intro;
        $row->sort = $r->sort;
        
 
            
        $row->parent_id = $r->parent_id??0;
        
      
        
        if($row->save()){
            return redirect()->route('services.index',['sub_div_id'=>$row->sub_div_id,'division_id'=>$row->subdivision->division_id])->with('success','Record updated');
        }
    }
    
    public function destroy($id){
        
        $row = Service::myServices()->findOrFail($id);
        
        if($row->products()->count() > 0 ){
            
            return back()->with('danger','Service has products. Remove or move the products then remove Service');
        }
        
        if($row->subs()->count() > 0 ){
            
            return back()->with('danger','Service has sub service');
        }
        
        
        
        // delete img
        $fileup = new FileUpload;
        $fileup->del_file($row->img);
        
        if($row->delete()){
            
            return back()->with('success','Service removed');
        }
    }

  
}
