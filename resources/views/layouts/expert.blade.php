<div class="row pt-2 pb-2 my-3" style="background-color: #EEE;">
    <div class="col-md-12 order-1 order-md-2 text-center text-md-left mb-5 mb-md-0">
        <h2 class="text-color-dark font-weight-normal text-6 mb-2 pb-1">Meet <strong class="font-weight-extra-bold">Our Experts</strong></h2>
        <ul class="list list-icons list-icons-style-3 mt-2">
			<li><i class="fas fa-map-marker-alt top-6"></i> <strong>Address:</strong> {{$data->address}}</li>
			<li><i class="fas fa-phone top-6"></i> <strong>Phone:</strong> {{$data->phone1}}{{$data->phone2?', '.$data->phone2:''}}</li>
			<li><i class="fas fa-envelope top-6"></i> <strong>Email:</strong> <a href="mailto:{{$data->email1}}">{{$data->email1}}</a> @if($data->email2), <a href="mailto:{{$data->email2}}">{{$data->email2}}</a> @endif</li>
		</ul>
    </div>
</div>