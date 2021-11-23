<?php
namespace App\Services;

use Illuminate\Support\Str;

class FileUpload {


	protected $path = 'uploads/';

	protected $file_name = null;



	public function upload($file){


			$file = $file;

			$st = ['status'=>'error', 'msg'=>'There is an error'];

			$ext = strtolower($file->getClientOriginalExtension());

			// set file name
			$file_name = time().'.'.$ext;
			
			if($this->file_name){
			    
			    $file_name = $this->file_name.'-'.time().'.'.$ext;
			}

			if($file->move($this->path,$file_name)){
			    
			    return $file_name;
			}

           	return false;

	}

	public function del_file($file){

		$file = $this->path.$file;

		if(is_file($file)){

			unlink($file);

			return true;
		}

		return false;
	}
	
	public function setFileName($name){
	    $this->file_name = $name;
	    return $this;
	}



	
	
}