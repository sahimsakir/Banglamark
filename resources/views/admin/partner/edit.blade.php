@extends('layouts.master')
@section('header','Admin | Edit Product')
@section('content')
@include('layouts.alert')
<form action="{{route('products.update',$row->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
<section class="card">
<header class="card-header">
	<div class="card-actions">
		<a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
		<a href="#" class="card-action card-action-dismiss" data-card-dismiss=""></a>
	</div>

	<h2 class="card-title">{{$row->name}}</h2>

	<p class="card-subtitle">
		Edit
	</p>
</header>
<div class="card-body">
	<div class="row form-group">
		<div class="col-lg-4">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Name</label>
				<input type="text" class="form-control" name="name" value="{{$row->name}}">
			</div>
		</div>
	</div>
	<div class="row form-group">
	
		<div class="col-lg-4">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Services</label>
				<select class="form-control" name="service_id" required disabled>
                    <option value="">Select</option>
                    @foreach($services as $serv)
                    <option value="{{$serv->id}}" {{$serv->id==$row->service_id?'selected':''}}>{{$serv->name}}</option>
                    @endforeach
                </select>
			</div>
		</div>
		<div class="col-lg-2">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Type</label>
				<select class="form-control" name="type" required>
                    <option value="">Select</option>
                    <option value="0" {{$row->type==0?'selected':''}}>Single</option>
                    <option value="1" {{$row->type==1?'selected':''}}>Multiple</option>
                 </select>
			</div>
		</div>
	</div>
	<label>Images</label>
	<div class="row form-group">
	    
		<div class="col-lg-3">
			<div class="form-group">
				<input type="file" name="img1">
			</div>
			@if($row->img1)
			<img src="{{asset('uploads/'.$row->img1)}}" width="200"><br>
			<input type="checkbox" name="rimg1" value="1"> Remove
			@endif
			
			
		</div>
    	<div class="col-lg-3">
    			<div class="form-group">
    				<input type="file" name="img2">
    			</div>
    			@if($row->img2)
    			<img src="{{asset('uploads/'.$row->img2)}}" width="200"><br>
    			<input type="checkbox" name="rimg2" value="1"> Remove
    			@endif
    	</div>
		
    	<div class="col-lg-3">
    			<div class="form-group">
    				<input type="file" name="img3">
    			</div>
    			@if($row->img3)
    			<img src="{{asset('uploads/'.$row->img3)}}" width="200"><br>
    			<input type="checkbox" name="rimg3" value="1"> Remove
    			@endif
    	</div>
    	<div class="col-lg-3">
    		<div class="form-group">
    			<input type="file" name="img4">
    		</div>
    		@if($row->img4)
    		<img src="{{asset('uploads/'.$row->img4)}}" width="200"><br>
    		<input type="checkbox" name="rimg4" value="1"> Remove
    		@endif
    	</div>
	
		
		
	</div>
	
	<div class="row form-group">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Short Intro</label>
				<textarea class="form-control" name="short_intro" id="editor1" rows="8">{!!$row->short_intro!!}</textarea>
			</div>
		</div>
	</div>

	<div class="row form-group">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Intro</label>
				<textarea class="form-control" name="intro" id="editor2" rows="8">{!!$row->intro!!}</textarea>
			</div>
		</div>
	</div>
</div>
<footer class="card-footer text-right">
	<button type="submit" class="btn btn-primary">Save</button>
	<a class="btn btn-default" href="{{route('products.index')}}?service_id={{$row->service_id}}">Back</a>
</footer>
</section>
</form>
            

@stop
