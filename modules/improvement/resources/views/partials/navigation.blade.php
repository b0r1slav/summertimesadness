<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand">
                {{ config('app.name') }}
            </a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('home') }}">Home</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Route::has('login'))
                    @auth
                        <li>
                            <a>{{ Auth::user()->name }}</a>
                        </li>
                        @if(Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('admin/dashboard') }}">Dashboard</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="glyphicon glyphicon-log-out"></span> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                --}}
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>