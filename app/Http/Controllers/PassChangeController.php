<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Division;


class PassChangeController extends Controller
{
    
    

    public function index(){
       
     return view('admin.user.change_password');

    }


    
    public function update(Request $r){
            
        $user = auth()->user();
        
        if($user){
            
            $this->validate($r,[
                
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                
                ]);

            $user->password = Hash::make($r->password);
            
            $user->save();
            
            return back()->with('success','Password has been changed');
        }
        
        abort(404);
         
        
      
        
    }
    
    
}
