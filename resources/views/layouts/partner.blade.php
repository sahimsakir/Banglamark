@if(count($partners) > 0)
<div class="row text-center mt-3 pb-1 mb-1">
    <div class="col-lg-12 text-center">

		<div class="divider divider-style-3 divider-primary taller vdiv-logo mt-0">
			<i class="fas fa-chevron-down"></i>
		</div>
			
        <h3 class="font-weight-normal mb-1">Our <strong class="font-weight-bold">Alliance Partners</strong></h3>
        <p class="lead">Here are some of our major straingth in this {{$data->name}}</p>
        <div class="row justify-content-center mt-3">
            <div class="owl-carousel owl-theme" data-plugin-options="{'items': 6, 'autoplay': true, 'autoplayTimeout': 3000}">
            
            @foreach($partners as $partner)    
			<div>
                <img class="img-fluid" src="{{asset('uploads/'.$partner->img)}}" alt="{{$partner->title}}">
            </div>
            @endforeach
            
			</div>
        </div>
    </div>
</div>
@endif