@extends('layouts.master')
@section('header','Edit Page')
@section('content')
@include('layouts.alert')
<form action="{{route('pages.update',$row->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
<section class="card">
<header class="card-header">
	<div class="card-actions">
		<a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
		<a href="#" class="card-action card-action-dismiss" data-card-dismiss=""></a>
	</div>

	<h2 class="card-title">{{$row->title}}</h2>

	<p class="card-subtitle">
		Edit
	</p>
</header>
<div class="card-body">
	<div class="row form-group">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Title</label>
				<input type="text" class="form-control" name="title" value="{{$row->title}}">
			</div>
		</div>
	</div>
	<div class="row form-group">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Slug</label>
				<input type="text" class="form-control" name="slug" value="{{$row->slug}}">
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
				<label class="col-form-label" for="formGroupExampleInput">Meta KW</label>
				<input type="text" class="form-control" name="meta_kw" value="{{$row->meta_kw}}">
			</div>
		</div>
	</div>
	<div class="row form-group">
		<div class="col-lg-3">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Sort</label>
				<input type="number" class="form-control" name="sort" value="{{$row->sort}}">
			</div>
		</div>
	    <div class="col-lg-4">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Status</label><br>
				<input type="hidden" class="form-control" name="status" value="0">
				<input type="checkbox" class="" name="status" value="1" {{$row->status==1?'checked':''}}> Active
			</div>
		</div>
	
		
	
	</div>
	<div class="row form-group">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Body</label>
				<textarea class="form-control" name="body" id="editor1"  rows="5">{!!$row->body!!}</textarea>
			</div>
		</div>
	</div>


</div>
<footer class="card-footer text-right">
	<button type="submit" class="btn btn-primary">Save</button>
	<a class="btn btn-default" href="{{route('pages.index')}}">Back</a>
</footer>
</section>
</form>
            

@stop
