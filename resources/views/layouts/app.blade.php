<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Belajar CRUD - Workshop MI</title>
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal"><a href="{{ url('home') }}">Belajar CRUD</a></h5>
        <nav class="my-2 my-md-0 mr-md-3">
          <a class="p-2 text-dark" href="{{ route('kategori-produk.index') }}">Kategori</a>
          <a class="p-2 text-dark" href="{{ route('produk.index') }}">Produk</a>
        </nav>
    </div>

    <div class="container mt-5 mb-5">
        {{-- Ini Untuk Konten nya --}}
        @yield('content')
    </div>

    {{-- Buat Javascript --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @stack('scripts')
</body>
</html>