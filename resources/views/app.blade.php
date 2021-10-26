<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height: 100%">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

    <title>Results</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-md">
        <a class="navbar-brand" href="{{ route('home') }}">Halloween Vote</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteNamed('vote.form') ? 'active' : '' }}"
                       {{ Route::currentRouteNamed('vote.form') ? 'aria-current="page"' : '' }}
                       href="{{ route('vote.form') }}">Vote</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteNamed('results') ? 'active' : '' }}"
                       {{ Route::currentRouteNamed('results') ? 'aria-current="page"' : '' }}
                       href="{{ route('results') }}">Results</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<footer class="container my-3">
    <div class="card">
        <div class="card-body">
            This website is open-source and licenced under version 3 of the GNU General Public Licence,
            <a href="https://gitlab.dylanwilson.dev/dylan/halloween-voting-system" class="text-decoration-none">click
                here to see the source code</a>.  Copyright &copy; 2021 Dylan Wilson.
        </div>
    </div>
</footer>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>
