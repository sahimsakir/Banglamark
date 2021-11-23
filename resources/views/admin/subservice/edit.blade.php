@extends('layouts.master')
@section('header','Admin | Add/ Edit Product')
@section('content')
@include('layouts.alert')
<form action="{{route('products.update',$row->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
<section class="card">
<header class="card-header">

	<h2 class="card-title">{{$row->name}}</h2>

	<p class="card-subtitle">
		Add/Edit Product Details
	</p>
</header>
<div class="card-body">
	<div class="row form-group">
		<div class="col-lg-6">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Product for Service</label>
				<select class="form-control" name="service_id" style="min-height: 31px !important;" required>
                    <option value="">Select</option>
                    @foreach($services as $serv)
                    <option value="{{$serv->id}}" {{$serv->id==$row->service_id?'selected':''}}>{{$serv->name}}</option>
                    @endforeach
                </select>
			</div>
			
		</div>
	</div>
	<div class="row form-group">
	
		<div class="col-lg-6">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Product Name</label>
				<input type="text" class="form-control" style="min-height: 31px !important;" name="name" value="{{$row->name}}">
			</div>
		</div>
		<div class="col-lg-4">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Product Type</label>
				<select class="form-control" name="type" style="min-height: 31px !important;" required>
                    <option value="">Select</option>
                    <option value="0" {{$row->type==0?'selected':''}}>Product with Picture</option>
                    <option value="1" {{$row->type==1?'selected':''}}>Product with Picture & Details</option>
                 </select>
			</div>
		</div>
	</div>
	<label>Images</label>
	<div class="row form-group">
	    
		<div class="col-lg-3">
		    @if($row->img1)
    			<img src="{{asset('uploads/'.$row->img1)}}" width="200"><br>
    			<input type="checkbox" name="rimg1" value="1" class="mb-2"> Remove
			@endif
			<div class="form-group">
    			<input type="file" name="img1">
    			<label><i>(Image Size: 600px by 450px)</i></label>
			</div>
			
		</div>
    	<div class="col-lg-3">
			@if($row->img2)
    			<img src="{{asset('uploads/'.$row->img2)}}" width="200"><br>
    			<input type="checkbox" name="rimg2" value="1" class="mb-2"> Remove
			@endif
			<div class="form-group">
				<input type="file" name="img2">
				<label><i>(Image Size: 600px by 450px)</i></label>
			</div>
			
    	</div>
		
    	<div class="col-lg-3">
    	    @if($row->img3)
    			<img src="{{asset('uploads/'.$row->img3)}}" width="200"><br>
    			<input type="checkbox" name="rimg3" value="1" class="mb-2"> Remove
			@endif
			<div class="form-group">
				<input type="file" name="img3">
				<label><i>(Image Size: 600px by 450px)</i></label>
			</div>
			
    	</div>
    	<div class="col-lg-3">
    		@if($row->img4)
        		<img src="{{asset('uploads/'.$row->img4)}}" width="200"><br>
        		<input type="checkbox" name="rimg4" value="1" class="mb-2"> Remove
    		@endif
    		<div class="form-group">
    			<input type="file" name="img4">
    			<label><i>(Image Size: 600px by 450px)</i></label>
    		</div>
    		
    	</div>
	
		
		
	</div>
	
	<div class="row form-group">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Product Short Intro</label>
				<textarea class="form-control" name="short_intro" id="editor1" rows="5">{!!$row->short_intro!!}</textarea>
			</div>
		</div>
	</div>

	<div class="row form-group">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Product Intro</label>
				<textarea class="form-control" name="intro" id="editor2" rows="8">{!!$row->intro!!}</textarea>
			</div>
		</div>
	</div>
</div>
<footer class="card-footer text-right">
	<button type="submit" class="btn btn-sm btn-primary">Save</button>
	<a class="btn btn-sm btn-default" href="{{route('products.index')}}?service_id={{$row->service_id}}">Back</a>
</footer>
</section>
</form>
            

@stop
