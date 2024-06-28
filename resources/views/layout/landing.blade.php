<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rumah KPR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .background-section {
            background-image: url('{{ asset('/assets/image/rumah.jfif') }}');
        }

        .nav-item.dropdown .dropdown-menu {
            display: none;
            b z-index: 1000;
        }

        .nav-item.dropdown.hover-dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>

<body>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
            })
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
            })
        </script>
    @endif
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-opacity[100%]">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing') }}">
                <img src="{{ asset('assets/image/logo.png') }}" alt="" width="100" height="84">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fs-5">
                    <li class="nav-item me-3">
                        <a class="nav-link fw-semibold" aria-current="page" href="{{ route('landing') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown me-3 hover-dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Perumahan
                        </a>
                        <ul class="dropdown-menu border-dropdown">
                            @foreach ($perumahan as $perum)
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('perumahan', $perum->id) }}">{{ $perum->nama }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item dropdown me-3 hover-dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Akun
                        </a>
                        <ul class="dropdown-menu">
                            @auth
                                <li>
                                    @if (Auth::user()->role == 'admin')
                                        <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                                    @else
                                        <a href="{{ route('akun') }}" class="dropdown-item">Akun</a>
                                    @endif
                                    @if (!Auth::user()->booking->isEmpty())
                                        <a href="{{ route('riwayat') }}" class="dropdown-item">Riwayat</a>
                                    @endif
                                <li><a href="{{ route('auth.logout') }}" class="dropdown-item">Logout</a></li>
                        </li>
                    @endauth
                    @guest
                        <li><a href="{{ route('auth.login') }}" class="dropdown-item">Login</a></li>
                    @endguest
                </ul>
                </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="bg-dark text-white pt-4">
        <div class="container p-5">
            <div class="row justify-content-between align-items-start">
                <div class="col-md-4 mb-3 text-md-start text-center">
                    <h5>Tentang Kami</h5>
                    <p>Kami adalah perusahaan yang berdedikasi untuk menyediakan layanan terbaik kepada pelanggan kami.
                        Kami
                        mengutamakan kualitas dan kepuasan pelanggan dalam setiap aspek bisnis kami.</p>
                </div>
                <div class="col-md-4 mb-3 text-md-center text-center">
                    <h5>Tautan</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Home</a></li>
                        <li><a href="#" class="text-white">Perumahan</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Kontak</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-geo-alt-fill"></i> Alamat: Jl. Contoh No. 123, Kota, Negara</li>
                        <li><i class="bi bi-telephone-fill"></i> Telepon: +62 123 4567 890</li>
                        <li><i class="bi bi-envelope-fill"></i> Email: <a href="mailto:info@contoh.com"
                                class="text-white">info@contoh.com</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bg-secondary text-center py-3">
            <div class="container">
                <p class="mb-0">© 2024 Dytech.</p>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script>
        var splide = new Splide('.splide', {
            perPage: 3,
            lazyLoad: 'nearby',
        });

        splide.mount();
    </script>
</body>

</html>
