@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">

            <!-- Notifikasi menggunakan flash session data -->
            @include('layouts.message')

            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <form action="{{ route('kategori-produk.update', $kategori_produk->id) }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="nama_kategori">Nama Kategori</label>
                            <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"
                                name="nama_kategori" value="{{ old('nama_kategori', $kategori_produk->nama_kategori) }}">

                            <!-- error message untuk nama_kategori -->
                            @error('nama_kategori')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-md btn-primary">Update</button>
                        <a href="{{ route('kategori-produk.index') }}" class="btn btn-md btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection