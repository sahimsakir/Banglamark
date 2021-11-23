@extends('layouts.master')
@section('header','Admin | Manage Videos')
@section('content')
@include('layouts.alert')
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-2">
                    <form>
                   <div class="row">
                       <div class="col-4">
                            <select data-plugin-selectTwo class="form-control populate" name="sub_div_id" style="height: 31px !important;">
                                <option value="">Select Sub-Division</option>
                                @foreach($subdivisions as $sub)
                                 <option value="{{$sub->id}}" {{$sub->id==request()->sub_div_id?'selected':''}}>{{$sub->division->name.' > '.$sub->name}}</option>
                                @endforeach
                            </select>
                            <style>
                                .select2-container--bootstrap .select2-selection--single {
                                    height: 31px !important;
                                    padding-top: 3px !important;
                                }
                            </style>
                       </div>
                       <div class="col-4">
                           <input type="submit" class="btn btn-primary btn-sm" value="Filter">
                           <button type="button" class="modal-with-form btn btn-primary btn-sm" href="#modalForm">+ Add New</button>
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
                				<th class="p-1" style="width: 20%">Title</th>
                				<th class="p-1" style="width: 20%">Link</th>
                				<th class="p-1" style="width: 30%">Image</th>
                				<th class="p-1" style="width: 5%">Sort</th>
                                <th class="p-1" style="width: 10%">Action</th>
                			</tr>
                		</thead>
                		<tbody>
                            
                			@foreach($rows as $row)
                			<tr>
                				<td class="p-1">{{++$p}}.</td>
                				<td class="p-1 text-left">{{$row->title}}</td>
                				<td class="p-1 text-left">{{$row->yt_link}}</td>
                				<td class="p-0">
                				    <img src="{{asset('uploads/'.$row->img)}}" height="30">
                				</td>
                				<td class="p-1 text-left">{{$row->sort}}</td>
                				<td class="p-1">
                					<form action="{{route('videos.destroy',$row->id)}}" method="post" onsubmit="return confirm('Are you sure, do you want to Delete?');">
                					    @csrf
                					    @method('delete')
                					    <button type="button" class="modal-with-form btn btn-primary btn-xs" href="#editForm{{$row->id}}">
                					        <i class="fas fa-pen"></i>
                					    </button>
                					    <button type="submit" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                					</form>
                				</td>
            
                			</tr>
                			
                			<!--edit-->
                			<div id="editForm{{$row->id}}" class="modal-block modal-block-primary mfp-hide">
                                    <section class="card">
                                         
                                        <header class="card-header">
                                            <h2 class="card-title">Edit</h2>
                                        </header>
                                        <div class="card-body">
                                        <form action="{{route('videos.update',$row->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Sub Division</label>
                                                <select class="form-control" name="sub_div_id">
                                                    <option value="">Select</option>
                                                    @foreach($subdivisions as $sub)
                                                     <option value="{{$sub->id}}" {{$sub->id==$row->sub_div_id?'selected':''}}>{{$sub->division->name.' - '.$sub->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Title</label>
                                                <input type="text" class="form-control" name="title" value="{{$row->title}}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">YouTube LInk</label>
                                                <input type="text" class="form-control" name="yt_link" value="{{$row->yt_link}}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Sort</label>
                                                <input type="text" class="form-control" name="sort" value="{{$row->sort}}">
                                            </div>
                                        </div>
                                        
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Thumb Image <i>(Image Size: 230px by 80px)</i></label>
                                                <input type="file" class="form-control" name="img">
                                                
                                                @if($row->img)
                                                 <img src="{{asset('uploads/'.$row->img)}}" width="200">
                                                @endif
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
                                        </form>
                                    </section>
                                </div>
                			<!--/edit-->
                            
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
        <form action="{{route('videos.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputEmail4">Sub Division</label>
                <select class="form-control" name="sub_div_id">
                    <option value="">Select</option>
                    @foreach($subdivisions as $sub)
                     <option value="{{$sub->id}}" >{{$sub->division->name.' - '.$sub->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputEmail4">Title</label>
                <input type="text" class="form-control" name="title">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputEmail4">YouTube LInk</label>
                <input type="text" class="form-control" name="yt_link">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputEmail4">Thumb Image <i>(Image Size: 230px by 80px)</i></label>
                <input type="file" class="form-control" name="img">
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
        </form>
    </section>
</div>

@stop
