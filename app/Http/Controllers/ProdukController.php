<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk; 
use App\Models\KategoriProduk;

class ProdukController extends Controller
{
    //
    public function index() {
        $produk = Produk::with('kategori_produks')->orderBy('nama_produk', 'asc')->get();
        return view('produk.index', compact('produk'));
    }

    public function create() {
        $kategori = KategoriProduk::orderBy('nama_kategori', 'asc')->get();
        return view('produk.create', compact('kategori'));
    }

    public function store(Request $request) 
    {

        // dd($request);

        $this->validate($request,[
            'kategori_id' => 'required|max:100',
            'nama_produk' => 'required|max:100',
            'jumlah_produk' => 'required|max:100'
        ]);


        $produk = Produk::create([
            'kategori_id' => $request->kategori_id,
            'nama_produk' => $request->nama_produk,
            'jumlah_produk' => $request->jumlah_produk
        ]);
        if ($produk){
            return redirect()->route('produk.index')->with(['success' => 'Data Produk Berhasil Disimpan']);
        } else{
            return redirect()->back()->withInput()->with(['eror' => 'Gagal Menyimpan data produk']);
        }
    }
     
     //mengambil.data untuk di edit

    public function edit(Produk $produk) 
    {
        $kategori = KategoriProduk::orderBy('nama_kategori', 'asc')->get();
        return view('produk.edit',compact('produk', 'kategori'));
    }

    public function update(Request $request, Produk $produk) 
    {
        $this->validate($request,[
            'kategori_id' => 'required|max:100',
            'nama_produk' => 'required|max:100',
            'jumlah_produk' => 'required|max:100'
        ]);

        $produk->update([
            'kategori_id' => $request->kategori_id,
            'nama_produk' => $request->nama_produk,
            'jumlah_produk' => $request->jumlah_produk
        ]);
        
            return redirect()->route('produk.index')->with(['success' => 'Data Produk Berhasil Di Update']);
        
    }

    public function delete(Produk $produk)
    {
        $produk->delete();
       
        return redirect()->route('produk.index')->with(['success' => 'Data Produk Berhasil Di Hapus']);
    }
}
