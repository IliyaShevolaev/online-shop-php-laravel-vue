<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SmartMart Admin Panel</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="d-flex">
        {{-- Sidebar --}}
        <div class="d-flex flex-column p-3 text-white sidebar-bg position-fixed"
            style="width: 190px; height: 100vh; background-color: #282d33;">
            <h4 class="fs-4"><a class="text-decoration-none text-light" href="{{ route('admin.index') }}">SmartMart</a>
            </h4>
            <ul class="nav flex-column fs-5">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#"><i class="bi bi-cart-fill"></i> Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('products.index') }}"><i class="bi bi-book-fill"></i>
                        Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('categories.index') }}"><i class="bi bi-justify"></i>
                        Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('genres.index') }}"><i class="bi bi-vector-pen"></i>
                        Genres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('users.index') }}"><i class="bi bi-people-fill"></i>
                        Customers</a>
                </li>
            </ul>
        </div>

        {{-- Navbar --}}
        <div class="flex-grow-1" style="margin-left: 190px;">
            <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #538ee5;">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link text-white" href="#">Home <span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white disabled" href="#">Disabled</a>
                        </li>
                    </ul>
                </div>
            </nav>

            {{-- Content --}}
            <div class="p-4" style="height: calc(100vh - 56px); overflow-y: auto;">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>
