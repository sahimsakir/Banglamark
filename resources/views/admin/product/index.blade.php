@extends('layouts.master')
@section('header','Admin | Manage Product')
@section('content')

    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-2">
                 
                    <button type="button" class="modal-with-form btn btn-sm btn-primary" href="#modalForm">+ Add New Product</button>
                    <a href="{{route('services.index',['sub_div_id'=>request()->sub_div_id,'division_id'=>request()->division_id])}}" class="btn btn-sm btn-default">Back</a>
                </div>
                
                <div class="card-body p-2">
                    
                	<table class="table table-bordered text-center">
                		<thead>
                			<tr>
                				<th class="p-1" style="width: 5%">Sl.</th>
                				<th class="p-1" style="width: 35%">Service's Name</th>
                				<th class="p-1" style="width: 35%">Product's Name</th>
                				<th class="p-1" style="width: 15%">Product's Image</th>
                                <th class="p-1" style="width: 10%">Action</th>
                			</tr>
                		</thead>
                		<tbody>
                            
                			@foreach($rows as $row)
                			<tr>
                				<td class="p-1">{{++$p}}</td>
                				<td class="p-1 text-left">{{$row->service->name}}</td>
                				<td class="p-1 text-left">@if($row->type ==0)<i class="far fa-image" title="Product with Picture"></i>@endif @if($row->type ==1)<i class="far fa-images" title="Product with Picture & Details"></i>@endif {{$row->name}}</td>
                				<td class="p-0"><img src="{{asset('uploads/'.$row->img1)}}" height="30"></td>
                				<td class="p-1">
                					
                				<form action="{{route('products.destroy',$row->id)}}" method="post" onsubmit="return confirm('Are you sure?');">
                				        @csrf
                				        @method('delete')
                				        
                					<a href="{{route('products.edit',$row->id)}}" class="btn btn-xs btn-warning">
                					    <i class="fas fa-pen"></i>
                					</a>
                				        <button type="submit" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button>
                				    </form>
                				</td>
                			</tr>
                            
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
        <form action="{{route('products.store')}}" method="post">
        @csrf
        <input type="hidden" name="service_id" value="{{request()->service_id}}">
        <div class="form-row">
            
             <div class="form-group col-md-12">
                <label for="inputEmail4">Type</label>
                <select class="form-control" name="type" required>
                    <option value="">Select</option>
                    <option value="0">Product with Picture</option>
                    <option value="1">Product with Picture & Details</option>
                 </select>
            </div>
        
        </div>
        
         <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputEmail4">Product Name</label>
                <input type="text" class="form-control" name="name">
            </div>
        </div>
        
        </div>

        <footer class="card-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <input type="submit" value="Next" class="btn btn-primary">
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
        
    </section>
</div>

@stop
