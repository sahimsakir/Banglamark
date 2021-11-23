<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Division;


class UserController extends Controller
{
    
    

    public function index(Request $r, User $user){
        
     
        
        $rows = $user->newQuery();

        if($r->name){

            $rows = $rows->where('name','LIKE','%'.$r->name.'%');
        }

        $pg = 20;
        $p = ($r->input('page',1)-1)*$pg;

        $rows = $rows->paginate($pg);
         
     return view('admin.user.index',compact('rows','p'));

    }
    
    public function create(){
        
        $divs = Division::all();
        
        return view('admin.user.create',compact('divs'));
    }

    public function store(Request $r){

    
        $this->validate($r,[
            'name' => 'required|min:4',
            'email'=>'required|unique:users,email|max:50',

        ]);

       


        $data  = new User;

        $data->name = $r->name;
        $data->email = $r->email;
        $data->phone = $r->phone;
        $data->password = Hash::make('banglamark');
        $data->active = $r->active;
        
        if(count($r->divs)){
            
            $divs = implode(',',$r->divs);
            
            $data->divisions = $divs;
 
        }


        if($data->save()){
            return redirect()->route('users.index')->with('success','User has been registered');
        }



    }
    
    public function edit(Request $r, User $user){
        
        $divs = Division::all();
        
        $mydivs = explode(',',$user->divisions);
        
        return view('admin.user.edit',compact('user','divs','mydivs'));
        
    }
    
    public function update(Request $r,$id){
        
        
         $this->validate($r,[

            'name' => 'required|min:5',
            'email'=>'required||max:50|unique:users,email,'.$id,

        ]);


        
        $data = User::findOrFail($id);
        
        $data->name = $r->name;
        $data->email = $r->email;
        $data->phone = $r->phone;
        $data->active = $r->active;
        
        $mydivs = null;
        
        if(is_array($r->divs) && count($r->divs)){
           $mydivs = implode(',',$r->divs); 
        }

        $data->divisions = $mydivs;
        
        if($data->save()){
            return redirect()->route('users.index')->with('success','User has been updated');
        }

        
    }
    
    public function destroy($id){
        
        $user = User::findOrFail($id);
        
        if($user->delete()){
            return back()->with('success','User has been removed');
        }
        
    }
    
    
}
