@props([
    'title' => ''
])

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Bob Nouri-M" />
    <title>{{ $title }} | Larapics</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="{{ asset("css/style.css") }}" />
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <x-icon src="logo.svg"  width="30"
            height="24"
            class="d-inline-block align-text-top color-light"/>

          Larapics
        </a>

         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="btn btn-secondary" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item  ms-2">
                                    <a class="btn btn-danger" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item">
                            <a href="{{ route('images.index') }}" class="nav-link {{ request()->is('account/images*') ? 'active' : '' }}">My Photos</a></li>
                        <li class="nav-item">
                            <a href="{{ route('favorites.index') }}" class="nav-link {{ request()->is('account/favorites*') ? 'active' : '' }}">Favorites</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('comments.index') }}" class="nav-link {{ request()->is('account/comments*') ? 'active' : '' }}">Comments</a>
                        </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('settings.edit') }}" class="dropdown-item">Settings</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
   {{ $slot }}
    <footer class="bg-light text-muted py-3 mt-5 border-top">
      <div class="container-fluid">
        <p class="float-end mb-1">
          <a href="#" class="text-decoration-none">Back to top</a>
        </p>
        <p>
          Larapics provides beautiful, high quality & royalty free photos shared
          by creators everywhere.
        </p>
        <p>&copy; 2022 Larapics</p>
      </div>
    </footer>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>

    <script
      async
      src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
      integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D"
      crossorigin="anonymous"
    ></script>
    <script>
      Promise.all(
        Array.from(document.images)
          .filter((img) => !img.complete)
          .map(
            (img) =>
              new Promise((resolve) => {
                img.onload = img.onerror = resolve;
              })
          )
      ).then(() => {
        var msnry = new Masonry(".image-grid");
        msnry.layout();
      });
    </script>
  </body>
</html>

