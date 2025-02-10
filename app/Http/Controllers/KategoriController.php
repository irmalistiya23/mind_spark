<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Buku;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua kategori untuk sidebar
        $kategoris = Kategori::all();
        
        // Mulai query builder untuk buku
        $query = Buku::query();
        
        // Filter berdasarkan kategori yang dipilih
        if ($request->has('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }
        
        // Filter berdasarkan pencarian jika ada
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'LIKE', "%{$search}%")
                  ->orWhere('penulis', 'LIKE', "%{$search}%")
                  ->orWhere('deskripsi', 'LIKE', "%{$search}%");
            });
        }
        
        // Ambil buku dengan pagination
        $bukus = $query->latest()
                      ->paginate(9)
                      ->withQueryString();
        
        // Ambil nama kategori yang aktif jika ada
        $activeKategori = null;
        if ($request->has('kategori_id')) {
            $activeKategori = Kategori::find($request->kategori_id);
        }
        
        return view('kategori', compact('kategoris', 'bukus', 'activeKategori'));
    }

    public function show($id)
    {
        $kategori = Kategori::findOrFail($id);
        $bukus = Buku::where('kategori_id', $id)->get();
        return view('kategori', compact('kategori', 'bukus'));
    }
}
