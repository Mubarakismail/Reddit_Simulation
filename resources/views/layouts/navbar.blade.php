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
                <a href=" {{ route('login') }}" class="btn btn-rounded-pill btn-outline-primary">log In</a>
                <a href=" {{ route('register') }}" class="btn btn-rounded-pill btn-primary">Sign Up</a>
            @else
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <a href="{{ route('Users.edit', ['id' => Auth::user()->id]) }}" class="btn btn-success">
                            <span><i class="fa fa-user"></i></span>{{ Auth::user()->username }}</a>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="{{ route('User.edit', ['id' => Auth::user()->id]) }}" class="dropdown-item">
                            <div class="media">
                                <span><i class="fa fa-user"></i></span>
                                <h3>Profile</h3>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>

                        <a href="{{ route('Posts.create') }}" class="dropdown-item">
                            <div class="media">
                                <span><i class="fa fa-comments"></i></span>
                                <h3>Create Post</h3>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>

                        <a data-toggle="modal" data-target="#createCommunity" class="dropdown-item">
                            <div class="media">
                                <span><i class="fa fa-people"></i></span>
                                <h3>Create Community</h3>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>

                        <a href="{{ route('logout') }}" class="dropdown-item">
                            <div class="media">
                                <span><i class="fa fa-back"></i></span>
                                <h3>logout</h3>
                            </div>
                        </a>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</nav>
<!-- /.navbar -->
