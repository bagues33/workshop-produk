@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">

            <!-- Notifikasi menggunakan flash session data -->
            @include('layouts.message')

            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <form action="{{ route('produk.update', $produk->id) }}" method="POST">
                        @csrf
                        
                       <div class="form-group">
                            <label for="nama_kategori">Nama Kategori<span class="text-danger">*</span></label>
                            <select class="form-control" name="kategori_id" id="nama_kategori">
                                @forelse ($kategori as $value)
                                    <option value="{{ $value->id }}">{{ $value->nama_kategori }}</option>
                                @empty
                                    <option>Kategori tidak ada</option>
                                @endforelse
                                <!-- <option value="{{ $produk->id }}">{{ $produk->nama }}</option> -->
                            </select>
                            <!-- error message untuk nama_kategori -->
                            @error('nama_kategori')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama_produk">Nama Produk<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}">
                            <!-- error message untuk nama_kategori -->
                            @error('nama_produk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jumlah_produk">Jumlah Produk<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('n') is-invalid @enderror" name="jumlah_produk" value="{{ old('jumlah_produk', $produk->jumlah_produk) }}">
                            <!-- error message untuk nama_kategori -->
                            @error('nama_kategori')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-md btn-primary">Update</button>
                        <a href="{{ route('produk.index') }}" class="btn btn-md btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection