<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriProduk; // tambahkan statement use model yang kita gunakan

class KategoriController extends Controller
{
    //untuk menampilkan data
    public function index() {
        $kategori = KategoriProduk::orderBy('nama_kategori', 'asc')->get();
        return view('kategori.index', compact('kategori'));
    }

    public function create() {
        return view('kategori.create');
    }

    public function store(Request $request) 
    {
        $this->validate($request,['nama_kategori' => 'required|string|max:100|unique:kategori_produks,nama_kategori']);

        $kategori = KategoriProduk::create([
            'nama_kategori' => $request->nama_kategori]);
        if ($kategori){
            return redirect()->route('kategori-produk.index')->with(['success' => 'Data Kategori Berhasil Disimpan']);
        } else{
            return redirect()->back()->withInput()->with(['eror' => 'Gagal Menyimpan data kategori']);
        }
    }
     
     //mengambil.data untuk di edit

    public function edit(KategoriProduk $kategori_produk) 
    {
        return view('kategori.edit',compact('kategori_produk'));
    }

    public function update(Request $request, KategoriProduk $kategori_produk) 
    {
        $this->validate($request,['nama_kategori' => 'required|string|max:100|unique:kategori_produks,nama_kategori,' . $kategori_produk->id
        ]);

        $kategori_produk->update([
            'nama_kategori' => $request->nama_kategori
        ]);
        
            return redirect()->route('kategori-produk.index')->with(['success' => 'Data Kategori Berhasil Di Update']);
        
    }

    public function delete(KategoriProduk $kategori_produk)
    {
        $kategori_produk->delete();
       
        return redirect()->route('kategori-produk.index')->with(['success' => 'Data Kategori Berhasil Di Hapus']);
    }

}