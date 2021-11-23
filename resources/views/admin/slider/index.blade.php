@extends('layouts.master')
@section('header','Admin | Manage Slider')
@section('content')
@include('layouts.alert')
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-2">
                    <form>
                   <div class="row">
                       @php
                        $arr = ['Division','Sub-division','Page'];
                       @endphp
                       <div class="col-4">
                            <select class="form-control" name="type" style="min-height: 31px !important;">
                                <option value="">Select Type</option>
                                @foreach($arr as $type)
                                 <option value="{{$type}}" {{$type==request()->type?'selected':''}}>{{$type}}</option>
                                @endforeach
                            </select>
                       </div>
                       <div class="col-3">
                           <input type="submit" class="btn btn-sm btn-primary" value="Filter">
                           <button type="button" class="modal-with-form btn btn-sm btn-primary" href="#modalForm">+ Add New Slider</button>
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
                				<th class="p-1" style="width: 15%">Sliding Picture</th>
                				<th class="p-1" style="width: 35%">Title</th>
                				<th class="p-1" style="width: 10%">Type</th>
                				<th class="p-1" style="width: 30%">Slide For</th>
                                <th class="p-1" style="width: 5%">Action</th>
                			</tr>
                		</thead>
                		<tbody>
                            
                			@foreach($rows as $row)
                			<tr>
                				<td class="p-1">{{++$p}}.</td>
                				<td class="p-0">
                				    <img src="{{asset('uploads/'.$row->img)}}" height="50">
                				</td>
                				<td class="p-1 text-left">{{$row->title}}</td>
                				<td class="p-1 text-left">{{$row->type}}</td>
                				<td class="p-1 text-left"></td>
                				<td class="p-1">
                					<form action="{{route('sliders.destroy',$row->id)}}" method="post" onsubmit="return confirm('Are you sure, do you want to Delete?');">
                					    @csrf
                					    @method('delete')
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

<!-- modal -->
<div id="modalForm" class="modal-block modal-block-primary mfp-hide">
    <section class="card">
         
        <header class="card-header">
            <h2 class="card-title">Add New Slider</h2>
        </header>
        <div class="card-body">
        <form action="{{route('sliders.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputEmail4">Type</label>
                <select class="form-control" name="type" id="type">
                    <option value="">Select</option>
                    @foreach($arr as $type)
                    <option value="{{$type}}" {{request()->type==$type?'selected':''}}>{{$type}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputEmail4">Parent ID</label>
                <select data-plugin-selectTwo class="form-control populate" name="parent_id" id="parent_id">
                    
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
                <label for="inputEmail4">Slider <i>(Image Size: 1440px by 600px)</i></label>
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

@section('script')

<script>
$(function(){
    
    let type = "{{request()->type}}";
    
    getitems(type);
    
});

    $('#type').on('change',function(){
        
       
        
        let type = $(this).val();

            getitems(type);
    });

function getitems(type){
    
      $.ajax({
            url:"{{route('get_type')}}",
            data:{type:type},
            success:function(data){
                $('#parent_id').html('');
                $('#parent_id').html(data);
            }
        });
}
</script>

@stop
