<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SubService;
use App\Models\Service;
use Illuminate\Support\Str;
use App\Services\FileUpload;

class SubServiceController extends Controller
{
    

    public function index(Request $r, SubService $rows){
        
        $rows = $rows->newQuery();
        
        if($r->service_id){
            $rows = $rows->where('service_id',$r->service_id);
        }
        
        $pg = 20;
        $p = ($r->input('page',1)-1 ) * $pg;
        
        $rows = $rows->with(['service'])->orderBy('id')->paginate($pg);
        $services = Service::with('subdivision')->orderBy('name')->get();
    	return view('admin.subservice.index',compact('rows','p','services'));

    }

    public function store(Request $r){
        
        $this->validate($r,[
            'service_id'=>'required',
            'name'=>'required',
            ]);
        
        $row = new SubService;
        $row->service_id = $r->service_id;
        $row->name = $r->name;
        $row->intro = $r->intro;
 
        
        if($row->save()){
            
            return back()->with('success','Sub service added');
        }

    }
    
    public function edit($id){
        
        $row = SubService::findOrFail($id);
        
        $services = Service::where('sub_div_id',$row->service->sub_div_id)->get();
        
        return view('admin.product.edit',compact('row','services'));
        
    }
    
    public function update(Request $r,$id){
        
        $this->validate($r,[
            'name'=>'required',
            ]);
        
        $row = SubService::findOrFail($id);
        

        $row->name = $r->name;
        $row->intro = $r->intro;

        
        if($row->save()){
            
            return back()->with('success','Updated');
        }
    }
    
    public function destroy($id){
        
        $row = SubService::findOrFail($id);

        $row->delete();
        
        
        return back()->with('success','Item has been removed');
        
    }

  
}
