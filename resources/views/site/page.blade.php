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
                            <h1 class="word-rotator slide font-weight-bold text-8 mb-0 appear-animation" data-appear-animation="maskUp"><span>{{$data->title}}</span></h1>
                        </div>
                        <div class="overflow-hidden mb-3">
                            <div class="lead mb-0 appear-animation text-justify" data-appear-animation="maskUp" data-appear-animation-delay="100">
                            {!!$data->body!!}
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
            </div>
        </div>
        
            <!--Partners-->
            @include('layouts.partner')
            <!--/Partners-->
    </div>

      
@stop