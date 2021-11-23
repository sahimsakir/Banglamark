@extends('layouts.master')
@section('header','Admin | Create Users')
@section('content')
@include('layouts.alert')

    <div class="row ">
        <div class="col-md-12">
            <div class="card">
          
                <h3>User Register</h3>
                <div class="card-body p-2">
                    
                    <form action="{{route('users.store')}}" method="post">
                        @csrf
                        
                        <div class="row form-group">
                    		<div class="col-lg-6">
                    			<div class="form-group">
                    				<label class="col-form-label" for="formGroupExampleInput">Name</label>
                    				<input type="text" class="form-control" name="name" required>
                    			</div>
                    		</div>
                    		<div class="col-lg-6">
                    			<div class="form-group">
                    				<label class="col-form-label" for="formGroupExampleInput">Email</label>
                    				<input type="email" class="form-control" name="email" required>
                    			</div>
                    		</div>
                    	</div>
                    	<div class="row form-group">
                    		<div class="col-lg-6">
                    			<div class="form-group">
                    				<label class="col-form-label" for="formGroupExampleInput">Phone</label>
                    				<input type="number" class="form-control" name="phone" required>
                    			</div>
                    		</div>
                    		<div class="col-lg-6">
                    			<div class="form-group">
                    				<label class="col-form-label" for="formGroupExampleInput">Active</label><br>
                    				<input type="checkbox"  name="active" value="1" checked>
                    			</div>
                    		</div>
                    	</div>
                    	<div class="row form-group">
                    		<div class="col-lg-12">
                    		    <table class="table">
                    		        <thead>
                    		            <tr>
                    		                <th>Sn</th>
                    		                <th>Division</th>
                    		                <th>Access</th>
                    		            </tr>
                    		        </thead>
                    		        <tbody>
                    		            @foreach($divs as $k => $div)
                    		            <tr>
                    		                <td>{{++$k }}</td>
                    		                <td>{{$div->name}}</td>
                    		                <td><input type="checkbox" name="divs[]" value="{{$div->id}}"></td>
                    		            </tr>
                    		            @endforeach
                    		        </tbody>
                    		    </table>
                    		   
                    			
                    		</div>
                    	</div>
                    	
                    	<div class="row form-group">
                    		<div class="col-lg-12">
                    			<div class="form-group">
                    				<input type="submit" class="btn btn-success">
                    				<a href="{{route('users.index')}}" class="btn btn-default">Back</a>
                    			</div>
                    		</div>
                    	</div>
                    </form>
                	
                </div>

                
            </div>
        </div>
    </div>
</div>




@endsection