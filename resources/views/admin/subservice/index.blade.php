@extends('layouts.master')
@section('header','Admin | Manage Sub Service')
@section('content')
@include('layouts.alert')
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-2">
                 
                    <button type="button" class="modal-with-form btn btn-sm btn-primary" href="#modalForm">+ Add New Sub Service</button>
                    <a href="{{route('services.index',['sub_div_id'=>request()->sub_div_id,'division_id'=>request()->division_id])}}" class="btn btn-sm btn-default">Back</a>
                </div>
                
                <div class="card-body p-2">
                    
                	<table class="table table-bordered text-center">
                		<thead>
                			<tr>
                				<th class="p-1" style="width: 5%">Sl.</th>
                				<th class="p-1" style="width: 35%">Service's Name</th>
                				<th class="p-1" style="width: 35%">Sub Service's Name</th>
                                <th class="p-1" style="width: 10%">Action</th>
                			</tr>
                		</thead>
                		<tbody>
                            
                			@foreach($rows as $row)
                			<tr>
                				<td class="p-1">{{++$p}}</td>
                				<td class="p-1 text-left">{{$row->service->name}}</td>
                				<td class="p-1 text-left">{{$row->name}}</td>
                				<td class="p-1">
                					
                				<form action="{{route('sub-services.destroy',$row->id)}}" method="post" onsubmit="return confirm('Are you sure?');">
                				        @csrf
                				        @method('delete')
                				        
                					<button type="button" class="modal-with-form btn-primary btn-xs" href="#editForm{{$row->id}}">
                					    <i class="fas fa-pen"></i>
                					</button>
                				        <button type="submit" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button>
                				    </form>
                				</td>
                			</tr>
                			<!--edit form-->
                			<div id="editForm{{$row->id}}" class="modal-block modal-block-primary mfp-hide">
                                    <section class="card">
                                         
                                        <header class="card-header">
                                            <h2 class="card-title">Add New</h2>
                                        </header>
                                        <div class="card-body">
                                        <form action="{{route('sub-services.update',$row->id)}}" method="post">
                                        @csrf
                                        @method('put')
                                       
                                        <div class="form-row">
                                        
                                        </div>
                                        
                                         <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Name</label>
                                                <input type="text" class="form-control" name="name" value="{{$row->name}}">
                                            </div>
                                        </div>
                                        
                                         <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Intro</label>
                                                <textarea class="form-control" name="intro" id="edito" rows="5">{{$row->intro}}</textarea>
                                            </div>
                                        </div>
                                        
                                        </div>
                                
                                        <footer class="card-footer">
                                            <div class="row">
                                                <div class="col-md-12 text-right">
                                                    <input type="submit" value="Update" class="btn btn-primary">
                                                    <button class="btn btn-default modal-dismiss">Cancel</button>
                                                </div>
                                            </div>
                                        </footer>
                                        
                                    </section>
                                </div>

                			<!--/edit form-->
                            
                			@endforeach
                		</tbody>
                	</table>
                	 {{$rows->appends(Request::except('page'))->links('pagination::bootstrap-4')}}
                </div>

                
            </div>
        </div>
    </div>

<!-- modal -->
<div id="modalForm" class="modal-block modal-block-primary mfp-hide">
    <section class="card">
         
        <header class="card-header">
            <h2 class="card-title">Add New</h2>
        </header>
        <div class="card-body">
        <form action="{{route('sub-services.store')}}" method="post">
        @csrf
        <input type="hidden" name="service_id" value="{{request()->service_id}}">
        <div class="form-row">
        
        </div>
        
         <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputEmail4">Name</label>
                <input type="text" class="form-control" name="name">
            </div>
        </div>
        
         <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputEmail4">Intro</label>
                <textarea class="form-control" name="intro" id="edito" rows="5"></textarea>
            </div>
        </div>
        
        </div>

        <footer class="card-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <input type="submit" value="Save" class="btn btn-primary">
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
        
    </section>
</div>

@stop
