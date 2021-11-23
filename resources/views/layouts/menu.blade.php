<aside id="sidebar-left" class="sidebar-left">
				
    <div class="sidebar-header">
        <div class="sidebar-title">
            Main Menu
        </div>
        <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>
				
	<div class="nano">
		<div class="nano-content">
		   <nav id="menu" class="nav-main" role="navigation">
    <ul class="nav nav-main">
        <!--  For Nav Active: nav-active nav-expanded !-->
        <li class="nav-active">
            <a class="nav-link" href="{{url('/dashboard')}}">
                <i class="fas fa-home" aria-hidden="true"></i>
                <span>Dashboard</span>
            </a>                        
        </li>
        <li class="nav-parent">
            <a class="nav-link" href="#">
                <i class="fas fa-tasks" aria-hidden="true"></i>
                <span>Manage Website</span>
            </a>
            <ul class="nav nav-children">
                <li>
                    <a class="nav-link" href="{{route('divisions.index')}}">
                        Divisions/ Sub-Division/ Services
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{route('partners.index')}}">
                        Partners
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{route('sliders.index')}}">
                        Slides
                    </a>
                </li>
                 <li>
                    <a class="nav-link" href="{{route('pages.index')}}">
                        Pages
                    </a>
                </li>
                 <li>
                    <a class="nav-link" href="{{route('videos.index')}}">
                        Videos
                    </a>
                </li>
                 <li>
                    <a class="nav-link" href="{{route('downloads.index')}}">
                        Downloadable Files
                    </a>
                </li>
                
            </ul>
        </li>
      
        @if(auth()->user()->role=='Admin')
        <li class="nav-parent">
            <a class="nav-link" href="#">
                <i class="fas fa-asterisk" aria-hidden="true"></i>
                <span>Admin</span>
            </a>
            <ul class="nav nav-children">
                <li>
                    <a class="nav-link" href="{{route('users.index')}}">
                        Users
                    </a>
                </li>
              
                
            </ul>
        </li>
        @endif
        

    </ul>
</nav>
				
 </div>
				
        <script>
            // Maintain Scroll Position
            if (typeof localStorage !== 'undefined') {
                if (localStorage.getItem('sidebar-left-position') !== null) {
                    var initialPosition = localStorage.getItem('sidebar-left-position'),
                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');
                    
                    sidebarLeft.scrollTop = initialPosition;
                }
            }
        </script>
        

    </div>

</aside>