@extends('layouts.master')
@section('header','Admin | Edit Service')
@section('content')
@include('layouts.alert')
<form action="{{route('services.update',$row->id)}}" method="post" enctype="multipart/form-data">
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
		<div class="col-lg-12">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Title</label>
				<input type="text" class="form-control" name="name" value="{{$row->name}}">
			</div>
		</div>
	</div>
	<div class="row form-group">
	
		<div class="col-lg-4">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Sub Division</label>
				<select class="form-control" name="sub_div_id" required>
                    <option value="">Select</option>
                    @foreach($sub_divisions as $sdiv)
                    <option value="{{$sdiv->id}}" {{$sdiv->id==$row->sub_div_id?'selected':''}}>{{$sdiv->name}}</option>
                    @endforeach
                </select>
			</div>
		</div>
		<div class="col-lg-2">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Sort</label>
				<input type="number" class="form-control" name="sort" value="{{$row->sort}}">
			</div>
		</div>
		<div class="col-lg-4">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Sub Service of</label>
				<select class="form-control" name="parent_id">
                    <option value="">Select</option>
                    @foreach($myservices as $serv)
                    <option value="{{$serv->id}}" {{$serv->id==$row->parent_id?'selected':''}}>{{$serv->subdivision->name.' - '.$serv->name}}</option>
                    @endforeach
                </select>
			</div>
		</div>
	</div>
	

	<div class="row form-group">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="col-form-label" for="formGroupExampleInput">Intro</label>
				<textarea class="form-control" name="intro" id="editor1" rows="8">{!!$row->intro!!}</textarea>
			</div>
		</div>
	</div>
</div>
<footer class="card-footer text-right">
	<button type="submit" class="btn btn-primary">Save</button>
	<a class="btn btn-default" href="{{route('services.index')}}?sub_div_id={{$row->sub_div_id}}">Back</a>
</footer>
</section>
</form>
            

@stop
