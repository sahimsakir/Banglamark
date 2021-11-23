@extends('layouts.site')
@section('content')
<div class="container py-5 my-4">
    <div class="row">
        <div class="col-lg-6">
            <div class="owl-carousel owl-theme" data-plugin-options="{'items': 1}">
                @if($row->img1)
                <div>
                    <img alt="" class="img-fluid" src="{{asset('uploads/'.$row->img1)}}" style="border: 1px solid #eee;"/>
                </div>
                @endif
                @if($row->img2)
                <div>
                    <img alt="" class="img-fluid" src="{{asset('uploads/'.$row->img2)}}" style="border: 1px solid #eee;"/>
                </div>
                @endif
                @if($row->img3)
                <div>
                    <img alt="" class="img-fluid" src="{{asset('uploads/'.$row->img3)}}" style="border: 1px solid #eee;"/>
                </div>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="summary entry-summary">
                <h4 class="modal-title" id="noAnimModalLabel">{{$row->name}}</h4>
                <div class="review-num text-primary mb-2">
                    {{$row->service->name}}
                </div>
                <p class="text-justify">
                    {!! $row->short_intro !!}
                </p>
                <div class="text-right">
                    <a href="{{URL::previous()}}" class="btn btn-sm btn-light mb-2">Back to Service Page</a>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <p class="text-justify">
                {!! $row->intro !!}
            </p>
        </div>
    </div>
</div>

@stop
            