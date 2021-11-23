@extends('layouts.site')
@section('meta_title','Power and Industrial Solutions -Technology Solution BD |Banglamark')
@section('meta_kw','Power and Industrial Solutions, Technology Solution Bangladesh, Heavy Industries Solutions, complex business solution')
@section('meta_des','Banglamark is one stop place for power, industrial, Heavy Industries, Energy and Technology Solution. Get the heavy industries and complex business solution in Bangladesh.')
@section('content')
@include('layouts.slider')

				<div class="container py-5 my-4">
					<div class="row text-center py-3">
						<div class="col-md-10 mx-md-auto">
							<h2 class="font-weight-normal mb-2">Welcome to <strong class="font-weight-bold">BANGLAMARK</strong></h2>
							<p class="lead appear-animation mb-0" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="300">
								BANGLAMARK started its journey with a mission to meet the challenge and demand of globalize business environment through effective marketing strategies and have been providing project solution for the last one decade. BANGLAMARK, being a global wing have planned to transform the company into Engineering Unit, Service & Project facilities management Unit, and exploring investment with global player in Energy sector, Construction equipment sector and infrastructure sector of Bangladesh.
							</p>
                            <a href="about-overview.php" class="btn btn-outline btn-primary btn-sm mt-2 mb-2" data-appear-animation="fadeInUpShorter">More Details</a>
						</div>
					</div>
				</div>

            <section class="section bg-primary border-0 pt-2 m-0 appear-animation vbg-solution" data-appear-animation="fadeIn">
            <div class="container">
                <div class="row text-center mt-5 pb-1 mb-1">
                    <div class="col-lg-12 text-center">
                        <h3 class="font-weight-normal mb-1 text-color-light">Our <strong class="font-weight-bold">Solution</strong></h3>
                        <p class="lead text-color-light">Here are the Major Solution provided by BANGLAMARK</p>
                    </div>
                </div>
                <div class="row py-3 justify-content-center">
                    @foreach($divisions as $div)
					<div class="col-sm-8 col-md-4 mb-4 mb-md-0 appear-animation" data-appear-animation="fadeIn">
						<article>
							<div class="row">
								<div class="col">
									<a href="{{route('division',$div->slug)}}">
										<span class="thumb-info thumb-info-no-borders thumb-info-no-borders-rounded thumb-info-lighten">
											<span class="thumb-info-wrapper">
												<img src="{{asset('uploads/'.$div->img)}}" class="img-fluid" alt="">
											</span>
										</span>
									</a>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<h4 class="mb-0"><a href="{{route('division',$div->slug)}}" class="text-2 pt-2 pb-3 text-uppercase font-weight-bold d-block text-light text-decoration-none text-color-light">{{$div->name}}</a></h4>
								</div>
							</div>
						</article>
					</div>
					@endforeach
					
				</div>
            </div>
            </section>
@stop
            