@extends('layouts.master')
@section('header','Add/ Edit Sub-Division')
@section('content')
@include('layouts.alert')
<form action="{{route('sub-divisions.update',$row->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
<section class="card">
<header class="card-header">
	<h2 class="card-title">{{$row->name}}</h2>
	<p class="card-subtitle">
		Add/ Edit Sub-Division
	</p>
</header>
<div class="card-body">
	<div class="row form-group">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Sub-Division Name</label>
				<input type="text" class="form-control" name="name" value="{{$row->name}}">
			</div>
		</div>
	</div>
	<div class="row form-group">
		<div class="col-lg-6">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Slug</label>
				<input type="text" class="form-control" name="slug" value="{{$row->slug}}">
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Division</label>
				<select class="form-control" name="division_id" required disabled>
                    <option value="">Select</option>
                    @foreach($divisions as $div)
                    <option value="{{$div->id}}" {{$div->id==$row->division_id?'selected':''}}>{{$div->name}}</option>
                    @endforeach
                </select>
			</div>
		</div>
	</div>
		<div class="row form-group">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Meta Title</label>
				<input type="text" class="form-control" name="meta_title" value="{{$row->meta_title}}">
			</div>
		</div>
	</div>
		<div class="row form-group">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Meta Description</label>
				<input type="text" class="form-control" name="meta_des" value="{{$row->meta_des}}">
			</div>
		</div>
	</div>
	<div class="row form-group">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Meta Keyword</label>
				<input type="text" class="form-control" name="meta_kw" value="{{$row->meta_kw}}">
			</div>
		</div>
	</div>
	<div class="row form-group">
		<div class="col-lg-2">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Sorting</label>
				<input type="number" class="form-control" name="sort" value="{{$row->sort}}">
			</div>
		</div>
		<div class="col-lg-4">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Image</label>
				<input type="file" class="form-control" name="img">
				<label><i>(Image Size: 600px by 400px)</i></label>
			</div>
		</div>
		@if($row->img)
		<div class="col-lg-6">
			<img src="{{asset('uploads/'.$row->img)}}" width="200">
			<label>
			    <input type="checkbox" name="remove_file" value="1"> Remove file
		    </label>
		</div>
		@endif
		
	</div>
	<div class="row form-group">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Short Intro </label> ( <span id=charcount></span>)
				<textarea class="form-control" id="short_intro" name="short_intro"  rows="5" maxlength="140" onkeyup="charcountupdate(this.value)">{!!$row->short_intro!!}</textarea>
			</div>
		</div>
	</div>
	<script>
	    function charcountupdate(str) {
        	var lng = str.length;
        	document.getElementById("charcount").innerHTML = lng + ' out of 140 characters';
        }
	</script>
	<div class="row form-group">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Intro</label>
				<textarea class="form-control " id="editor2" name="intro" rows="8">{!!$row->intro!!}</textarea>
			</div>
		</div>
	</div>
	<div class="row form-group">
	    <div class="col-lg-12">
	        <h4 class="mb-0">Sub-Division's Expert Details:</h4>
	    </div>
		<div class="col-lg-12">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Address</label>
				<input type="text" class="form-control" name="address" value="{{$row->address}}">
			</div>
		</div>
		<div class="col-lg-3">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Phone 1</label>
				<input type="text" class="form-control" name="phone1" value="{{$row->phone1}}">
			</div>
		</div>
		<div class="col-lg-3">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Phone 2</label>
				<input type="text" class="form-control" name="phone2" value="{{$row->phone2}}">
			</div>
		</div>
		<div class="col-lg-3">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Email 1</label>
				<input type="text" class="form-control" name="email1" value="{{$row->email1}}">
			</div>
		</div>
		<div class="col-lg-3">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Email 2</label>
				<input type="text" class="form-control" name="email2" value="{{$row->email2}}">
			</div>
		</div>
		
	</div>

	
</div>
<footer class="card-footer text-right">
	<button type="submit" class="btn btn-sm btn-primary">Save</button>
	<a class="btn btn-sm btn-default" href="{{route('sub-divisions.index')}}?division_id={{$row->division_id}}">Back</a>
</footer>
</section>
</form>
            

@stop
