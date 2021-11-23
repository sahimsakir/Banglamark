<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Support\Str;
use App\Services\FileUpload;

class ProductController extends Controller
{
    

    public function index(Request $r, Product $rows){
        
        $rows = $rows->newQuery();
        
        if($r->service_id){
            $rows = $rows->where('service_id',$r->service_id);
        }
        
        $pg = 20;
        $p = ($r->input('page',1)-1 ) * $pg;
        
        $rows = $rows->myProducts()->with(['service'])->orderBy('id')->paginate($pg);
        $services = Service::with('subdivision')->orderBy('name')->get();
    	return view('admin.product.index',compact('rows','p','services'));

    }

    public function store(Request $r){
        
        $this->validate($r,[
            'service_id'=>'required',
            'name'=>'required',
            ]);
        
        $row = new Product;
        $row->service_id = $r->service_id;
        $row->name = $r->name;
        $row->type = $r->type;
 
        
        if($row->save()){
            
            return redirect()->route('products.edit',$row->id);
        }

    }
    
    public function edit($id){
        
        $row = Product::myProducts()->findOrFail($id);
        
        $services = Service::where('sub_div_id',$row->service->sub_div_id)->get();
        
        return view('admin.product.edit',compact('row','services'));
        
    }
    
    public function update(Request $r,$id){
        
        $this->validate($r,[
            'name'=>'required',
            'service_id'=>'required'
            ]);
        
        $row = Product::myProducts()->findOrFail($id);
        
        $row->service_id = $r->service_id;
        $row->name = $r->name;
        $row->short_intro = $r->short_intro;
        $row->intro = $r->intro;
        $row->type = $r->type;
        
        $fileup = new FileUpload;
        
        
        if($r->img1){
            $fileup1 = new FileUpload;
            $img1 = $fileup1->upload($r->img1);
            $fileup1->del_file($row->img1);
            $row->img1 = $img1;
        }
        
        if($r->img2){
            $fileup2 = new FileUpload;
            $img2 = $fileup2->upload($r->img2);
            $fileup2->del_file($row->img2);
            $row->img2 = $img2;
        }
        
        if($r->img3){
            $fileup3 = new FileUpload;
            $img3 = $fileup3->upload($r->img3);
            $fileup3->del_file($row->img3);
            $row->img3 = $img3;
        }
        
        if($r->img4){
            $fileup4 = new FileUpload;
            $img4 = $fileup4->upload($r->img4);
            $fileup4->del_file($row->img4);
            $row->img4 = $img4;
        }
        
        // remove images
        if($r->rimg1){
            $fileup->del_file($row->img1);
            $row->img1 = null;
            
        }
        
         if($r->rimg2){
            $fileup->del_file($row->img2);
            $row->img2 = null;
            
        }
        
         if($r->rimg3){
            $fileup->del_file($row->img3);
            $row->img3 = null;
            
        }
        
        if($r->rimg4){
            $fileup->del_file($row->img4);
            $row->img4 = null;
            
        }
      
        
        if($row->save()){
            return redirect()->route('products.index',['service_id'=>$row->service_id,'sub_div_id'=>$row->service->sub_div_id,'division_id'=>$row->service->subdivision->division_id])->with('success','Product updated');
        }
    }
    
    public function destroy($id){
        
        $row = Product::myProducts()->findOrFail($id);
        
        $fileup = new FileUpload;
        
        if($row->img1){
            
            $fileup->del_file($row->img1);
        }
        if($row->img2){
            
            $fileup->del_file($row->img2);
        }
        if($row->img3){
            
            $fileup->del_file($row->img3);
        }
        if($row->img4){
            
            $fileup->del_file($row->img4);
        }
        
        // delete product
        
        $row->delete();
        
        
        return back()->with('success','Product has been removed');
        
    }

  
}
