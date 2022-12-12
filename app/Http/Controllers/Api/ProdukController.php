<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    //
    public function list() 
    {
        // dd('p');

        try{
            $data = Produk::orderBy('nama_produk','asc')->get();
            return response()->json([ 
                'status' => true,
                'message' => 'Data List Produk', 
                'data' => $data,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan',
                'data' => $e->getMessage()
            ], 500); }
    }

    public function view($id) {
        try{
            $data = Produk::where('id', $id)->first();
            return response()->json([
                'status' => true,
                'message' => 'Data View Produk',
                'data' => $data,
            ], 201);
        } catch (\Exception $e) { 
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan', 
                'data' => $e->getMessage()
            ], 500); }
    }

    public function create(Request $request) {
        $this->validate($request,[ 
            'nama_produk' => [ 'required','string','max:100','unique:produks,nama_produk'], 
            'kategori_id' => [ 'required','numeric','max:100'], 
            'jumlah_produk' => [ 'required','numeric','max:100'], 
            ],[ 
                'nama_produk.required' => 'Nama Produk Wajib Diisi', 
                'kategori_id.required' => 'Kategori Produk Wajib Diisi', 
                'jumlah_produk.required' => 'Jumlah Produk Wajib Diisi', 
                'nama_produk.unique' => 'Nama Produk Sudah Ada',
            ]);
        try {
            $produk = Produk::create([
                'nama_produk' => $request->nama_produk,
                'kategori_id' => $request->kategori_id,
                'jumlah_produk' => $request->jumlah_produk
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Data Produk Berhasil Disimpan', 
                'data' => $produk
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan', 'data' => $e->getMessage()
            ], 500); }
    }

    public function update(Request $request, $id) {
        $produk = Produk::where('id',$id)->first(); 
            if(!$produk){
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized! Tidak ditemukan', 'data' => []
                ], 400); 
            }

            $this->validate($request,[ 
                'nama_produk' => ['required','string','max:100','unique:produks,nama_produk,' . $produk->id],
                'kategori_id' => ['required','numeric','max:100'],
                'jumlah_produk' => ['required','numeric','max:100'],

            ],[ 
                'nama_produk.required' => 'Nama Produk Wajib Diisi', 
                'kategori_id.required' => 'Kategori Produk Wajib Diisi', 
                'jumlah_produk.required' => 'Jumlah Produk Wajib Diisi', 
                'nama_produk.unique' => 'Nama Produk Sudah Ada' 
            ]);

            try{
                $produk->nama_produk = $request->nama_produk; 
                $produk->kategori_id = $request->kategori_id;
                $produk->jumlah_produk = $request->jumlah_produk;
                $produk->update();
                    return response()->json([
                        'status' => true,
                        'message' => 'Data Produk Berhasil di Update', 'data' => $produk
                    ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Terjadi kesalahan', 
                    'data' => $e->getMessage()
                ], 500); }
    }

    public function delete($id) {
        try {
            $produk = Produk::where('id', $id)->first(); if(!$produk){
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized! Tidak ditemukan', 'data' => []
                ], 400); }
            $produk->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Berhasil menghapus data produk', 'data' => [],
                ], 200);
        } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Terjadi kesalahan',
                    'data' => $e->getMessage() ], 500);
        } 
    }
}
