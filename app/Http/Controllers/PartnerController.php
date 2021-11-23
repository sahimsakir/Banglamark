<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Partner;
use App\Models\SubDivision;
use Illuminate\Support\Str;
use App\Services\FileUpload;

class PartnerController extends Controller
{
    

    public function index(Request $r, Partner $rows){
        
        $rows = $rows->newQuery();
        
        $rows = $rows->whereActive(1);
        
        if($r->sub_div_id){
            $rows = $rows->where('sub_div_id',$r->sub_div_id);
        }
        
        $pg = 20;
        $p = ($r->input('page',1)-1 ) * $pg;
        
        $rows = $rows->myPartners()->with(['subdivision'])->orderBy('id')->paginate($pg);
        $subdivisions = SubDivision::mySubDivs()->with('division')->orderBy('division_id')->get();
        
    	return view('admin.partner.index',compact('rows','p','subdivisions'));

    }

    public function store(Request $r){
        
        $this->validate($r,[
            'sub_div_id'=>'required',
            'title'=>'required',
            'img'=>'required'
            ]);
        
        $row = new Partner;
        $row->sub_div_id = $r->sub_div_id;
        $row->title = $r->title;
       
        if($r->img){
            
            $fileup = new FileUpload;
            $file = $fileup->upload($r->img);
            $row->img = $file;
        }
        
        if($row->save()){
            
            return back()->with('success','Partner added');
        }

    }
    
   
    
    public function destroy($id){
        
        $row = Partner::myPartners()->findOrFail($id);
        
        $fileup = new FileUpload;
        
        $fileup->del_file($row->img);
        
        $row->delete();
        
        return back()->with('success','Partner removed');
    }

  
}
