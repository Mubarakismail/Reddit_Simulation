<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="{{ route('Posts.index') }}" class="navbar-brand">
            <img src="{{ asset('img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Reddit</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('Posts.index') }}" class="nav-link">Home</a>
                </li>
            </ul>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            @if (!Auth::check())
                <li class="nav-item">
                    <a href=" {{ route('login') }}" class="btn btn-rounded-pill btn-outline-primary">log In</a>
                </li>
                <li class="nav-item">
                    <a href=" {{ route('register') }}" class="btn btn-rounded-pill btn-primary">Sign Up</a>
                </li>
            @else
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle btn-info" style="color: white" href="#"
                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <span><i class="fa fa-user"></i></span>
                        {{ Auth::user()->username }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a href="{{ route('Users.edit', ['User' => Auth::user()->id]) }}" class="dropdown-item">
                            <h5><span><i class="fa fa-user"></i></span> Profile</h5>
                        </a>
                        <div class="dropdown-divider"></div>

                        <a href="{{ route('Posts.create') }}" class="dropdown-item">
                            <h5><span><i class="fa fa-comments"></i></span> Create Post</h5>
                        </a>
                        <div class="dropdown-divider"></div>

                        <a data-toggle="modal" data-target="#createCommunity" class="dropdown-item btn">
                            <h5> <span><i class="fas fa-users"></i></span> Create Community</h5>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="btn dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</nav>
<!-- /.navbar -->
