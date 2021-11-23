<div class="slider-container light rev_slider_wrapper" style="height: 530px;">
	<div id="revolutionSlider" class="slider rev_slider" data-version="5.4.8" data-plugin-revolution-slider data-plugin-options="{'delay': 9000, 'gridwidth': 1170, 'gridheight': 530, 'disableProgressBar': 'on', 'responsiveLevels': [4096,1200,992,500], 'navigation' : {'arrows': { 'enable': true, 'style': 'arrows-style-1 arrows-big arrows-dark' }, 'bullets': {'enable': false, 'style': 'bullets-style-1 bullets-color-primary', 'h_align': 'center', 'v_align': 'bottom', 'space': 7, 'v_offset': 70, 'h_offset': 0}}}">
		<ul>
		    @foreach($slides as $slide)
			<li data-transition="fade">
				<img src="{{asset('uploads/'.$slide->img)}}"  
					alt=""
					data-bgposition="right center"
					data-bgpositionend="center center"
					data-bgfit="cover" 
					data-bgrepeat="no-repeat" 
					data-kenburns="on"
					data-duration="9000"
					data-ease="Linear.easeNone"
					data-scalestart="110"
					data-scaleend="100"
					data-rotatestart="0"
					data-rotateend="0"
					data-offsetstart="0 0"
					data-offsetend="0 0"
					data-bgparallax="0"
					class="rev-slidebg">
				<div class="tp-caption font-weight-extra-bold text-color-light negative-ls-2 text-uppercase"
					data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:1.5;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
					data-x="center"
					data-y="center"
					data-fontsize="['50','50','50','74']"
					data-lineheight="['55','55','55','95']" style="text-shadow: #000 2px 2px 0;">{{$slide->title}}</div>
				<div class="tp-caption font-weight-light text-color-light"
					data-frames='[{"from":"opacity:0;","speed":300,"to":"o:1;","delay":2000,"split":"chars","splitdelay":0.05,"ease":"Power2.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'
					data-x="center"
					data-y="center" 
					data-fontsize="['18','18','18','50']"
					data-lineheight="['20','20','20','55']"
					style="color: #b5b5b5;" style="color: red !important;"></div>
			</li>
			@endforeach
			
			
			
			
		</ul>
	</div>
</div>