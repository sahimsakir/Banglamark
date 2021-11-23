@if(1)
<div class="row pt-5">
    <div class="col-md-6 mx-md-auto">
        <h4 class="text-uppercase">Download Section</h4>
        <table class="table table-bordered">
            <tr class="text-center">
                <td class="p-1"><b>Document Title</b></td>
                <td class="p-1"><b>Download</b></td>
            </tr>
             @foreach($downloads as $down)
            <tr>
                <td class="p-1 pl-2"><a href="downloads/power-generation.pdf" targer="_blank">{{$down->file}}</a></td>
                <td class="p-1 text-center"><a href="{{asset('uploads/'.$down->file)}}" targer="_blank"><i class="far fa-file-pdf"></i></a></td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="col-md-6 mx-md-auto">
        <h4 class="text-uppercase">Video Section</h4>
        <table class="table table-bordered">
            <tr class="text-center">
                <td class="p-1"><b>Video Title</b></td>
                <td class="p-1"><b>Play</b></td>
            </tr>
            @foreach($videos as $vid)
            <tr>
                <td class="p-1 pl-2" class="td-1"><a class="mt-1 mb-1 mr-1 popup-youtube" href="{{$vid->yt_link}}">{{$vid->title}} </a></td>
                <td class="p-1 text-center"><a class="mt-1 mb-1 mr-1 popup-youtube" href="{{$vid->yt_link}}"><i class="fas fa-play"></i></a></td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endif