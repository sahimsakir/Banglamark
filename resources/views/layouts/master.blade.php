<!doctype html>
<html class="fixed sidebar-left-sm">
@include('layouts.head')

@yield('style')

<style>
	.header {
    background: #fafdff;
    border-bottom: 1px solid #fafdff;
    border-top: 3px solid #fafdff;
    z-index: 1000;
}
</style>
	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="{{url('/dashboard')}}" class="logo m-1 ml-3">
						<img src="{{asset('theme/front/img/logo_v2.png')}}" height="47" alt="Banglamark Admin" />
					</a>
					<div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fas fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
					<span class="separator"></span>
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="{{asset('theme/front/img/profile.jpg')}}" alt="" class="rounded-circle" data-lock-picture="" />
							</figure>
							<div class="profile-info" data-lock-name="{{auth()->user()->name}}" data-lock-email="{{auth()->user()->email}}">
							
								<span class="name">{{auth()->user()->name}}</span>

							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled mb-2">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="{{route('change_password.index')}}"><i class="fas fa-user"></i> Change password</a>
								</li>
								<!-- <li>
									<a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fas fa-lock"></i> Lock Screen</a>
								</li> -->
								<li>
									<a role="menuitem" tabindex="-1" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i> Logout</a>

									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
			@include('layouts.menu')
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>@yield('header')</h2>
					</header>

					<!-- start: page -->
					@yield('content')
				
					<!-- end: page -->
				</section>
			</div>

			

		</section>

@include('layouts.footer')

<script>
	$(function(){

		setTimeout(function(){$('.alert-block').hide();},3000);
	});
</script>

@yield('script')
	</body>
</html>