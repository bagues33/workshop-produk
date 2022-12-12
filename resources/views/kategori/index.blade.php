@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Notifikasi menggunakan flash session data -->
        @include('layouts.message')

        <div class="card border-0 shadow rounded">
            <div class="card-body">
                <a href="{{ route('kategori-produk.create') }}" class="btn btn-md btn-success mb-3 float-right">Tambah Kategori</a>

                <table class="table table-bordered mt-1">
                    <thead>
                        <tr>
                            <th class="text-center">Nama Kategori</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kategori as $value)
                            <tr>
                                <td>{{ $value->nama_kategori }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                        action="{{ route('kategori-produk.delete', $value->id) }}" method="GET">
                                        <a href="{{ route('kategori-produk.edit', $value->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center text-mute" colspan="2">Data Kategori tidak tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
@endsection
