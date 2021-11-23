@extends('layouts.site')
@section('meta_title',$data->meta_title)
@section('meta_kw',$data->meta_kw)
@section('meta_des',$data->meta_des)
@section('content')
@include('layouts.slider')

	<div class="container">

        <div class="row pt-5">
            <div class="col">

                <div class="row">
                    <div class="col-md-12 mx-md-auto">
                        <div class="overflow-hidden mb-3 text-center">
                            <h1 class="word-rotator slide font-weight-bold text-8 mb-0 appear-animation" data-appear-animation="maskUp"><span>{{$data->name}}</span></h1>
                        </div>
                        <div class="overflow-hidden mb-3">
                            <div class="lead mb-0 appear-animation text-justify" data-appear-animation="maskUp" data-appear-animation-delay="100">
                            {!!$data->intro!!}
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
            </div>
        </div>
    </div>

            <div class="container">
                <div class="row text-center mt-5 pb-1 mb-1">
                    <div class="col-lg-12 text-center">
                        <h3 class="font-weight-normal mb-1"><strong class="font-weight-bold">{{$data->name}}</strong> Solution</h3>
                        <p class="lead">Here are the Major Solution provided by BANGLAMARK {{$data->name}}</p>
                    </div>
                </div>
                <div class="row py-3">
                    @foreach($data->subdivisions as $subdiv)
					<div class="col-sm-8 col-md-4 mb-4 mb-md-0 appear-animation" data-appear-animation="fadeIn">
						<article>
							<div class="row">
								<div class="col">
									<a href="{{route('sub.division',[$data->slug,$subdiv->slug])}}">
										<span class="thumb-info thumb-info-no-borders thumb-info-no-borders-rounded thumb-info-lighten">
											<span class="thumb-info-wrapper">
												<img src="{{asset('uploads/'.$subdiv->img)}}" class="img-fluid" alt="">
											</span>
										</span>
									</a>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<h4 class="mb-0"><a href="#" class="text-2 pt-2 text-uppercase font-weight-bold d-block text-dark text-decoration-none">{{$subdiv->name}}</a></h4>
									<p class="text-3 mb-2">
									    {{substr($subdiv->short_intro,0,140).'...'}}
									</p>
								    <a href="{{route('sub.division',[$data->slug,$subdiv->slug])}}" class="btn btn-primary btn-xs mb-4">More Details</a>
								</div>
							</div>
						</article>
					</div>
					
					@endforeach
						

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
         
      
@stop

        