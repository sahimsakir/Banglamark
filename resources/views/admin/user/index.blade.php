@extends('layouts.master')
@section('header','Admin | Manage Users')
@section('content')
@include('layouts.alert')

    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-2">
                        <form action="">
                        <div class="form-group row pb-2">
                            
                            <div class="col-lg-4 m-0 pr-1">
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{request()->name}}">
                            </div>

                            
                            <div class="col-lg-1 m-0 pl-1 pr-1">
                                <button type="submit" class="form-control btn btn-success">Search</button>
                               
                            </div>
                            
                            <div class="col-lg-1 m-0 pl-1 pr-1">
                                <a  class="btn btn-primary" href="{{route('users.create')}}">+New</a>
                            </div>
                            
                            <div class="col-lg-1 m-0 pl-1 pr-1">
                                <a href="{{route('users.index')}}" class="form-control btn btn-default" >Reset</a>
                            </div>
                            
                    </form>

                      <div class="card-actions">
                   
                    </div>

                </div>
                
                <div class="card-body p-2">
                    
                	<table class="table table-bordered text-center">
                		<thead>
                			<tr>
                				<th class="p-1">Sl</th>
                				<th class="p-1">Name</th>
                				<th class="p-1">Email</th>
                                <th class="p-1">Phone</th>
                                <th class="p-1">Status</th>
                                <th class="p-1">Action</th>
                			</tr>
                		</thead>
                		<tbody>
                            
                			@foreach($rows as $row)
                			<tr>
                				<td class="p-1">{{++$p}}</td>
                				<td class="p-1">{{$row->name}}</td>
                                <td class="p-1">{{$row->email}}</td>
                                <td class="p-1">{{$row->phone}}</td>
                                <td class="p-1">{{$row->active==1?'Active':'Inactive'}}</td>
                              
                				<td>
                				    
                					
                					
                					<form action="{{route('users.destroy',$row->id)}}" method="post" onsubmit="return confirm('Are you sure, do you want to Delete?');">
                					    @csrf
                					    @method('delete')
                					    <a href="{{route('users.edit',$row->id)}}" class="btn btn-primary btn-xs"><i class="fas fa-pen"></i></a>
                				
                					    <button type="submit" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
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
</div>




@endsection