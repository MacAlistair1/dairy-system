<nav class="navbar navbar-transparent navbar-absolute">
    <div class="container-fluid">
        <div class="navbar-minimize">
            {{-- <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                <i class="material-icons visible-on-sidebar-regular"></i>
                <i class="material-icons visible-on-sidebar-mini"></i>
            </button> --}}
        </div>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand btn btn-round btn-white" href="/home"> ड्यासबोर्ड </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="/home" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="material-icons"></i>
                        <p class="hidden-lg hidden-md">ड्यासबोर्ड</p>
                    </a>
                </li>
              
                @if (!Auth::guest())
                <li>
                        <a href="{{ route('logout') }}" class="dropdown-toggle"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            <b class="material-icons"><button class="btn btn-round btn-white btn-fill btn-just-icon">लग आउट</button></b>
                                            <p class="hidden-lg hidden-md">लग आउट</p>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                         </a>
                    </li>
                @endif
                <li class="separator hidden-lg hidden-md"></li>
            </ul>
           
        </div>
    </div>
</nav>