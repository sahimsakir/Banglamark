@extends('layouts.master')
@section('header','Admin | Manage Sub-Divisions')
@section('content')
@include('layouts.alert')
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-2">
                 
                    <button type="button" class="modal-with-form btn btn-sm btn-primary" href="#modalForm">+ Add New Sub-Division</button>
                    <a href="{{ route('divisions.index') }}" class="btn btn-sm btn-default">Back</a>
                    
                </div>
                
                <div class="card-body p-2">
                    
                	<table class="table table-bordered text-center">
                		<thead>
                			<tr>
                				<th class="p-1" style="width: 5%">Sl.</th>
                				<th class="p-1" style="width: 35%">Division's Name</th>
                				<th class="p-1" style="width: 30%">Sub Division's Name</th>
                				<th class="p-1" style="width: 15%">Services</th>
                				<th class="p-1" style="width: 5%">Sort</th>
                                <th class="p-1" style="width: 10%">Action</th>
                			</tr>
                		</thead>
                		<tbody>
                            
                			@foreach($rows as $row)
                			<tr>
                				<td class="p-1">{{++$p}}.</td>
                				<td class="p-1 text-left">{{$row->division->name}}</td>
                				<td class="p-1 text-left">{{$row->name}}</td>
                				<td class="p-1">
                				    <a href="{{route('services.index',['sub_div_id'=>$row->id,'division_id'=>request()->division_id])}}">
                				        Service ({{$row->services_count}})
                				    </a>
                				</td>
                				<td class="p-1">{{$row->sort}}</td>
                				<td class="p-1">
                					
                					<form action="{{route('sub-divisions.destroy',$row->id)}}" method="post" onsubmit="return confirm('Are you sure?');">
                				        @csrf
                				        @method('delete')
                				        <a href="{{route('sub-divisions.edit',$row->id)}}" class="btn btn-xs btn-warning">
                					    <i class="fas fa-pen"></i>
                					</a>
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
            <h2 class="card-title">Add New Sub Division</h2>
        </header>
        <div class="card-body">
        <form action="{{route('sub-divisions.store')}}" method="post">
        @csrf
        <input type="hidden" name="division_id" value="{{request()->division_id}}">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputEmail4">Sub Division Name</label>
                <input type="text" class="form-control" name="name" required>
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
