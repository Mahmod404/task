<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>App</title>
    <!-- fontawesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- bootstrap css -->
    <link rel = "stylesheet" href = "{{ asset('css/bootstrap.min.css') }}">
    <!-- custom css -->
    <link rel = "stylesheet" href = "{{ asset('css/main.css') }}">
</head>

<body>
    <!-- navbar -->
    <nav class = "navbar navbar-expand-lg navbar-light bg-light py-4 sticky-top z-3">
        <div class = "container">

            <a class = "navbar-brand d-flex justify-content-between align-items-center order-lg-0"
                href = "{{ route('home') }}">
                <span class = "text-uppercase fw-lighter ms-2">MyCash</span>
            </a>
            <div class = "order-lg-2 nav-btns me-5">
                <div class="dropdown position-relative">
                    <button class="btn btn-secondary dropdown-toggle px-4" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-regular fa-user"></i>
                    </button>
                    <ul class="dropdown-menu text-center">
                        @if (auth()->user())
                            <li><a class="dropdown-item border-bottom border-1 border-dark"
                                    href="{{ route('profile.edit') }}">Profile</a></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Log out') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @else
                            <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>

                            <li><a class="dropdown-item" href="{{ route('login') }}">Log in</a></li>
                        @endif
                    </ul>
                </div>
            </div>



            <button class = "navbar-toggler border-0" type = "button" data-bs-toggle = "collapse"
                data-bs-target = "#navMenu">
                <span class = "navbar-toggler-icon"></span>
            </button>

            <div class = "collapse navbar-collapse order-lg-1" id = "navMenu">
                <ul class = "navbar-nav mx-auto text-center">
                    <li class = "nav-item px-1 py-2 border-bottom border-danger me-1">
                        <a class = "nav-link text-uppercase text-dark" href = "{{ route('home') }}">home</a>
                    </li>
                    <li class = "nav-item px-1 py-2 border-bottom border-danger me-1">
                        <a class = "nav-link text-uppercase text-dark"
                            href = "{{ route('departments.index') }}">departments</a>
                    </li>
                    <li class = "nav-item px-1 py-2 border-bottom border-danger me-1">
                        <a class = "nav-link text-uppercase text-dark"
                            href = "{{ route('tasks.index') }}">Tasks</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end of navbar -->

    <!-- Content -->
    <div>
        @yield('content')
    </div>
    <!-- end of Content -->


    <!-- footer -->
    <footer class = "py-5 mt-5">
        <div class = "container">
            <div class = "row">

            </div>
        </div>
    </footer>
    <!-- end of footer -->

    <!-- scripts -->
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('js/script.js') }}"></script>
    <!-- end of scripts -->
</body>

</html>
