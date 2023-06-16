<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @layer demo{
            button {
                all:unset;
            }
        }
    </style>
    <title>@yield('title')</title>
</head>
<body>

    @php
        $routeName = request()->route()->getName();
    @endphp
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container-fluid">
          <a class="navbar-brand" href="/">Blog</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a @class(['nav-link', 'active' => $routeName ==='blog.index']) aria-current="page" href="{{ route('blog.index') }}">Blog</a>
              </li>
              <li class="nav-item">
                <a @class(['nav-link', 'active' => $routeName ==='blog.create']) href="{{ route('blog.create') }}">Créer</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
    <div class="container">
        @if (session('success'))
            <div class = 'alert alert-success'>
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </div>

</body>
</html>
