@extends('layout.template')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Tambahkan stylesheet atau link ke CDN CSS yang diperlukan di sini -->
</head>
<body>
    <div id="app">
        <header>
            <!-- Mungkin kamu ingin menambahkan header di sini -->
        </header>

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @section('sidebar')
                        <!-- Sidebar akan dimasukkan di sini -->
                    @show
                </div>

                <div class="col-md-9">
                    @yield('content')
                </div>
            </div>
        </div>

        <footer>
            <!-- Mungkin kamu ingin menambahkan footer di sini -->
        </footer>
    </div>

    <!-- Tambahkan script JavaScript atau link ke CDN JS yang diperlukan di sini -->
</body>
</html>