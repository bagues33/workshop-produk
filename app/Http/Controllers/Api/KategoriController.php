<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriProduk;

class KategoriController extends Controller
{
    //
    /**
        * menampilkan list data kategori * @method list
        * @return json
    */
    public function list() 
    {
        // dd('p');

        try{
            $data = KategoriProduk::orderBy('nama_kategori','asc')->get();
            return response()->json([ 
                'status' => true,
                'message' => 'Data List Kategori Produk', 
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
            $data = KategoriProduk::where('id', $id)->first();
            return response()->json([
                'status' => true,
                'message' => 'Data View Kategori Produk',
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
            'nama_kategori' => [ 'required','string','max:100','unique:kategori_produks,nama_kategori'] 
            ],[ 
                'nama_kategori.required' => 'Nama Kategori Wajib Diisi', 'nama_kategori.unique' => 'Nama Kategori Sudah Ada',
            ]);
        try {
            $kategori = KategoriProduk::create([
                'nama_kategori' => $request->nama_kategori 
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Data Kategori Berhasil Disimpan', 
                'data' => $kategori
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan', 'data' => $e->getMessage()
            ], 500); }
    }

    public function update(Request $request, $id) {
        $kategori = KategoriProduk::where('id',$id)->first(); 
            if(!$kategori){
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized! Tidak ditemukan', 'data' => []
                ], 400); 
            }

            $this->validate($request,[ 
                'nama_kategori' =>
            ['required','string','max:100','unique:kategori_produks,nama_kategori,' . $kategori->id]
            ],[ 
                'nama_kategori.required' => 'Nama Kategori Wajib Diisi', 'nama_kategori.unique' => 'Nama Kategori Sudah Ada' 
            ]);

            try{
                $kategori->nama_kategori = $request->nama_kategori; $kategori->update();
                    return response()->json([
                        'status' => true,
                        'message' => 'Data Kategori Berhasil di Update', 'data' => $kategori
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
            $kategori = KategoriProduk::where('id', $id)->first(); if(!$kategori){
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized! Tidak ditemukan', 'data' => []
                ], 400); }
            $kategori->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Berhasil menghapus data kategori', 'data' => [],
                ], 200);
        } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Terjadi kesalahan',
                    'data' => $e->getMessage() ], 500);
        } 
    }
    

}
