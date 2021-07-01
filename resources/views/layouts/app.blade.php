<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>BoolBnB</title>

  <!-- Scripts -->
  <script src="{{ asset('js/main.js') }}" defer></script>
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.13.0/maps/maps.css'>
  <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.13.0/maps/maps-web.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue"></script>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
  <div id="app">
    <nav class="navbar navbar-expand-md">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          <img src="{{ asset('img/logo-white.png') }}" alt="icon">
          <h2>BoolBnB</h2>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">

          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('search.advanced') }}">Adv Search</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
              </a>

              <div class=" icon dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="text-transform: uppercase;">
                <a class="dropdown-item" href="{{ route('admin.index') }}"><i class="fas fa-desktop"></i> {{ Auth::user()->name }} - Dashboard</a>
                <a class="dropdown-item" href="{{ route('admin.apartments.index') }}"> <i class="fas fa-home"></i> Appartamenti</a>
                <a class="dropdown-item" href="{{ route('admin.messages.index') }}"><i class="fas fa-envelope-open"></i> Messaggi</a>

                <a class="dropdown-item" href="{{ route('search.advanced') }}"><i class="fas fa-search-plus"></i> Adv Search</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                </a>



                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>
            </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>

    <main class=" bg-main">
      @yield('content')
    </main>
    <footer class="bg-footer">
      <div class="line-bottom">
        <!--  <h1>Team 6</h1> -->
        <div class="container ">
          <div class="card-wrap">
            <div class="box-footer text-center">
              <img src="{{ asset('img/icon-profile.jpg') }}" alt="profile">
              <h6>
                Alessandro Benigni
              </h6>
              <span><i class="fas fa-map-marker-alt"></i> Ancona</span>
              <div>
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href=""><i class="fab fa-github-square"></i></a>
              </div>

            </div>
            <div class="box-footer text-center">
              <img src="{{ asset('img/icon-profile.jpg') }}" alt="profile">
              <h6>
                Roy Naim
              </h6>
              <span><i class="fas fa-map-marker-alt"></i> Roma</span>
              <div>
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href=""><i class="fab fa-github-square"></i></a>
              </div>

            </div>
            <div class="box-footer text-center">
              <img src="{{ asset('img/icon-profile.jpg') }}" alt="profile">
              <h6>
                Tommaso Scocciolini
              </h6>
              <span><i class="fas fa-map-marker-alt"></i> Perugia</span>
              <div>
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href=""><i class="fab fa-github-square"></i></a>
              </div>

            </div>

            <div class="box-footer text-center">
              <img src="{{ asset('img/profiloo.jpg') }}" alt="profile">
              <h6>
                Walter Velardo
              </h6>
              <span><i class="fas fa-map-marker-alt"></i> Torino</span>
              <div>
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href=""><i class="fab fa-github-square"></i></a>
              </div>

            </div>
          </div>

        </div>
      </div>
      <div class="copyright container text-center py-50">
        <span>Progetto Finale Boolean Careers | BoolBnB by Team6 </span>
      </div>
    </footer>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue"></script>
</body>

</html>