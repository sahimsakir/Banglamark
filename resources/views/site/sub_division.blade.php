@extends('layouts.site')
@section('meta_title',$data->meta_title)
@section('meta_kw',$data->meta_kw)
@section('meta_des',$data->meta_des)
@section('content')
@include('layouts.slider')


        




 
    <div class="container">

        <div class="row pt-5">
            <div class="col">

                <div class="row pb-5">
                    <div class="col-md-12 mx-md-auto">
                        <div class="overflow-hidden mb-3 text-center">
                            <h1 class="word-rotator slide font-weight-bold text-8 mb-0 appear-animation" data-appear-animation="maskUp"><span>{{$data->name}}</span></h1>
                        </div>
                        <div class="overflow-hidden mb-3">
                            <div class="lead mb-0 appear-animation text-justify" data-appear-animation="maskUp" data-appear-animation-delay="100">
                            {!! $data->intro!!}
                            </div>
                        </div>
                    </div>
                </div>
                


                <div class="row">
					<div class="col-lg-4">
						<div class="tabs tabs-vertical tabs-right tabs-navigation tabs-navigation-simple">
							<ul class="nav nav-tabs col-sm-3">
							  @foreach($services as $k => $srv)
							    @if($srv->parent_id==0)
								<li class="nav-item {{$k==0?'active':''}}"><a class="nav-link" href="#tab{{$srv->id}}" data-toggle="tab">{{$srv->name}}</a></li>
								@endif
							  @endforeach
							</ul>
						</div>
					</div>
					
					<div class="col-lg-8">
					     @foreach($services as $k => $srv)
					      
						<div class="tab-pane tab-pane-navigation {{$k==0?'active':''}}" id="tab{{$srv->id}}">
							<h4 class="text-uppercase">{{$srv->name}}</h4>
							<span class="text-justify">{!!$srv->intro!!}</span>


                            @if(count($srv->subs))
                            <div class="toggle toggle-primary" data-plugin-toggle data-plugin-options="{ 'isAccordion': true }">
								@foreach($srv->subs as $i => $child)
								<section class="toggle {{$i==0?'active':''}}">
									<label>{{$child->name}}</label>
									<div class="toggle-content">
										{!!$child->intro!!}
            							<div class="row">
                                          @foreach($child->products as $pro)
                                          
                                          @if($pro->type==0)
                                         	<div class="col-lg-6">
                                    			<a class="img-thumbnail d-block lightbox" href="{{asset('uploads/'.$pro->img1)}}" data-plugin-options="{'type':'image'}">
                                    				<img class="img-fluid" src="{{asset('uploads/'.$pro->img1)}}" alt="Product Image">
                                    				<span class="zoom">
                                    					<i class="fa fa-search-plus"></i>
                                    				</span>
                                    			</a>
                                    			<h5 class="p-1 text-center">{{$pro->name}}</h5>
                                    		</div>
                                          @elseif($pro->type==1 && $pro->img1)
                                            
                                    		<div class="col-lg-6">
                                    			<a class="img-thumbnail d-block" href="{{route('product',[$pro->service->subdivision->division->slug,$pro->service->subdivision->slug,$pro->id])}}">
                                    				<img class="img-fluid" src="{{asset('uploads/'.$pro->img1)}}" alt="Product Image">
                                    			</a>
                                    			<h5 class="p-1 text-center">{{$pro->name}}</h5>
                                    		</div>
                                          
                                          @endif
            
                                    	@endforeach
                                    	</div>
									</div>
								</section>
								@endforeach
							</div>
							@endif
                        
                           
                        
                        <!--product images-->
                        
                          <div class="row">
                              @foreach($srv->products as $pro)
                              
                              @if($pro->type==0)
                             	<div class="col-lg-6">
                        			<a class="img-thumbnail d-block lightbox" href="{{asset('uploads/'.$pro->img1)}}" data-plugin-options="{'type':'image'}">
                        				<img class="img-fluid" src="{{asset('uploads/'.$pro->img1)}}" alt="Product Image">
                        				<span class="zoom">
                        					<i class="fa fa-search-plus"></i>
                        				</span>
                        			</a>
                        			<h5 class="p-1 text-center">{{$pro->name}}</h5>
                        		</div>
                              @elseif($pro->type==1 && $pro->img1)
                                
                        		 <div class="col-lg-6">
                        			<a class="img-thumbnail d-block" href="{{route('product',[$pro->service->subdivision->division->slug,$pro->service->subdivision->slug,$pro->id])}}">
                        				<img class="img-fluid" src="{{asset('uploads/'.$pro->img1)}}" alt="Product Image">
                        			</a>
                        			<h5 class="p-1 text-center">{{$pro->name}}</h5>
                        		</div>
                              
                              @endif
                              
                        	
                        		
                        		@endforeach
                        	
                        	</div>
						
						</div>
						@endforeach
	
					</div>
				</div>

                </div>
            </div>
            <!--expert-->
            @include('layouts.expert')
            <!--/expert-->
            <!--Downloads & Videos-->
            @include('layouts.video')
            <!--/Downloads & Videos-->
            
            <!--Partners-->
            @include('layouts.partner')
            
            <!--/Partners-->
            
        </div>
        
        
@stop