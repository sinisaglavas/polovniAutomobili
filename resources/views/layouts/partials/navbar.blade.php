<nav id="navbar" class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
            <a class="navbar-brand" href="{{ route('welcome') }}"><img src="/logo-small.jpg" alt="Logo"></a>
        <ul class="nav">
            @if (Route::has('login'))
                @auth
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="color: white; margin-top: 10px"><i class="fa-solid fa-envelope fa-2xl"></i></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a style="color: white; font-size: small" id="navbarDropdown" class="nav-link dropdown-toggle text-center" href="{{ url('/home') }}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                MOJ PROFIL<br>
                               {{ Auth::user()->email }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end bg-dark shadow-sm" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#" style="color: white" >Third</a>
                                <a class="dropdown-item" href="#" style="color: white">Fourth</a>
                                <a class="dropdown-item" href="#" style="color: white">Fifth</a>
                                <hr class="dropdown-divider" style="border: 1px solid lightgray">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="color: white">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary" href="{{ route('ad.categorySelection')  }}" style="margin-top: 15px">POSTAVI OGLAS</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}" style="color: white; margin-top: 2px; font-size: 13px;">PRIJAVI SE<br>Moj profil</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}" style="color: white; margin-top: 15px; font-size: 13px;">REGISTRUJ SE</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="btn btn-primary" href="{{ route('login')  }}" style="margin-top: 15px">POSTAVI OGLAS</a>
                        </li>
                @endauth
            @endif

        </ul>
    </div>

</nav>

