@extends('layouts.master')
@section('header','Admin | Manage Pages')
@section('content')
@include('layouts.alert')
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-2">
                    <form>
                   <div class="row">
                      
                       <div class="col-3">
                        
                           <button type="button" class="modal-with-form btn btn-primary btn-sm" href="#modalForm">+ Add New Page</button>
                       </div>
                   </div>
                   </form>
          
                     <div class="card-actions">
                         
                    </div>
                </div>
                
                <div class="card-body p-2">
                    
                	<table class="table table-bordered text-center">
                		<thead>
                			<tr>
                				<th class="p-1" style="width: 5%">Sl.</th>
                				<th class="p-1" style="width: 35%">Page Title</th>
                				<th class="p-1" style="width: 50%">Page Link</th>
                                <th class="p-1" style="width: 10%">Action</th>
                			</tr>
                		</thead>
                		<tbody>
                            
                			@foreach($rows as $row)
                			<tr>
                				<td class="p-1">{{++$p}}</td>
                				<td class="p-1 text-left">{{$row->title}}</td>
                				<td class="p-1 text-left">{{$row->slug}}</td>
                				<td class="p-1">
                					<form action="{{route('pages.destroy',$row->id)}}" method="post" onsubmit="return confirm('Are you sure, do you want to Delete?');">
                					    @csrf
                					    @method('delete')
                					    <button type="submit" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                					    <a href="{{route('pages.edit',$row->id)}}" class="btn btn-xs btn-warning">
                					        <i class="fas fa-pen"></i>
                					    </a>
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
        <form action="{{route('pages.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputEmail4">Title</label>
                <input type="text" class="form-control" name="title">
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
        </form>
    </section>
</div>

@stop
