<!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link type="text/css" href="{{ mix('css/app.css') }}" rel="stylesheet">
        <!-- Uneseno naknadno zbog upload images  -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
<body>
  <div id="app">
      <nav id="navbar" class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
          <div class="container">
              <a class="navbar-brand" href="{{ url('/') }}"><img src="/logo-small.jpg" alt="Logo"></a>
              <ul class="nav">
                  @guest
                      @if (Route::has('login'))
                          <li class="nav-item">
                              <a class="nav-link" href="{{ route('login') }}" style="color: white; margin-top: 2px; font-size: 13px;">PRIJAVI SE<br>Moj profil</a>
                          </li>
                      @endif
                      @if (Route::has('register'))
                          <li class="nav-item">
                              <a class="nav-link" href="{{ route('register') }}" style="color: white; margin-top: 15px; font-size: 13px;">REGISTRUJ SE</a>
                          </li>
                      @endif
                          <li class="nav-item">
                              <a class="btn btn-primary" href="{{ route('login')  }}" style="margin-top: 15px">POSTAVI OGLAS</a>
                          </li>
                  @else
                      <li class="nav-item">
                          <a class="nav-link" href="#" style="color: white; margin-top: 10px;"><i class="fa-solid fa-envelope fa-2xl"></i></a>
                      </li>
                      <li class="nav-item dropdown">
                          <a style="color: white; font-size: small" id="navbarDropdown" class="nav-link dropdown-toggle text-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              MOJ PROFIL<br>
                              {{ Auth::user()->email }}
                          </a>
                          <div class="dropdown-menu dropdown-menu-end bg-dark shadow-sm" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route('home') }}" style="color: orange" >Aktivni oglasi</a>
                              <a class="dropdown-item" href="#" style="color: orange">Neaktivni oglasi</a>
                              <a class="dropdown-item" href="{{ route('showMessages') }}" style="color: orange">Poruke</a>
                              <hr class="dropdown-divider" style="border: 1px solid orange">
                              <a class="dropdown-item" href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="color: orange">
                                  Odjavi se
                              </a>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                  @csrf
                              </form>
                          </div>
                      </li>
                      <li class="nav-item">
                          <a class="btn btn-primary" href="{{ route('ad.categorySelection') }}" style="margin-top: 15px">POSTAVI OGLAS</a>
                      </li>
                  @endguest
              </ul>
          </div>
      </nav>

      <main class="py-4">
        @yield('content')
      </main>
</div>

@include('layouts.partials.footer')

</body>
</html>
