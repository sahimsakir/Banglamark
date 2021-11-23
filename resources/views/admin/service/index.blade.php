@extends('layouts.master')
@section('header','Admin | Manage Services')
@section('content')
@include('layouts.alert')
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-2">
                 
                    <button type="button" class="modal-with-form btn btn-sm btn-primary" href="#modalForm">+ Add New Service</button>
                    <a href="{{ route('sub-divisions.index',['division_id'=>request()->division_id]) }}" class="btn btn-sm btn-default">Back</a>
                    
                </div>
                
                <div class="card-body p-2">
                    
                	<table class="table table-bordered text-center">
                		<thead>
                			<tr>
                				<th class="p-1" style="width: 5%">Sl.</th>
                				<th class="p-1" style="width: 22%">Sub Division's Name</th>
                				<th class="p-1" style="width: 22%">Service's Name</th>
                				<th class="p-1" style="width: 29%">Sub Service</th>
                				<th class="p-1" style="width: 10%">Products</th>
                				<th class="p-1" style="width: 5%">Sort</th>
                                <th class="p-1" style="width: 7%">Action</th>
                			</tr>
                		</thead>
                		<tbody>
                            
                			@foreach($rows as $row)
                			<tr>
                				<td class="p-1">{{++$p}}.</td>
                				<td class="p-1 text-left">{{$row->subdivision->name}}</td>
                				<td class="p-1 text-left">
                				    @if($row->parent_id==0)
                				    {{$row->name}}
                				    @else
                				    {{$row->pservice->name}}
                				    @endif
                				    
                				</td>
                				<td class="p-1 text-left">
                				     @if($row->parent_id > 0)
                				        {{$row->name}}
                				     @else
                				     -
                				    
                				    @endif
                				    
                				</td>
                				<td class="p-1">
                				    <a href="{{route('products.index',['service_id'=>$row->id,'sub_div_id'=>request()->sub_div_id,'division_id'=>request()->division_id])}}">
                					    Products ({{$row->products_count}})
                			        </a>
                				</td>
                				<td class="p-1">{{$row->sort}}</td>
                				<td class="p-1">
                					
                				    <form action="{{route('services.destroy',$row->id)}}" method="post" onsubmit="return confirm('Are you sure?');">
                				        @csrf
                				        @method('delete')
                				        
                					<a href="{{route('services.edit',$row->id)}}" class="btn btn-xs btn-warning">
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
        <form action="{{route('services.store')}}" method="post">
        @csrf
        <input type="hidden" name="sub_div_id" value="{{request()->sub_div_id}}">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputEmail4">Service Name</label>
                <input type="text" class="form-control" name="name">
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
        </form>
    </section>
</div>

@stop
