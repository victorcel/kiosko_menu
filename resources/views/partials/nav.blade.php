<header>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">

                    {{ config('app.name', 'Laravel') }}
                </a>
                @auth()
                    <a class="navbar-brand">Puntos: <span
                                class="badge label label-danger">{{ Auth::user()->points }}</span> </a>
                @endauth
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">

                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">

                    <!-- Authentication Links -->
                    @guest

                    <li><a href="{{ route('login') }}">Login</a></li>
                    @else
                        <a class="navbar-brand" href="{{ route('cart.show') }}"> <i style="font-size:30px" class="fa fa-cart-plus"> <span
                                        class="badge "> {{ Auth::user()->present()->cart() }}</span></i></a>

                        <li><a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Salir
                            </a></li>
                        @if (Auth::user()->type == 'admin' or Auth::user() == 'editor')
                            <li><a href={{ route('admin.home') }}>Administración</a></li>
                        @endif
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                <i class="fa fa-user"> {{ Auth::user()->name }}</i>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>


                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                                </li>
                            </ul>
                        </li>
                        @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
