<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function show($id)
    {
        // Ambil data buku beserta relasinya (kategori dan ulasan)
        $buku = Buku::with(['kategoris', 'ulasans.user'])->findOrFail($id);
        
        // Hitung rata-rata rating
        $averageRating = $buku->ulasans->avg('Rating') ?? 0;
        
        return view('buku', compact('buku', 'averageRating'));
    }

    public function store(Request $request)
    {
        // Implementasi penyimpanan buku
    }

    public function update(Request $request, $id)
    {
        // Implementasi pembaruan buku
    }

    public function destroy($id)
    {
        // Implementasi penghapusan buku
    }

    public function uploadCover(Request $request)
    {
        if ($request->hasFile('CoverBuku')) {
            $file = $request->file('CoverBuku');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/cover_buku', $filename);
            $buku = Buku::findOrFail($request->id);
            $buku->CoverBuku = $filename;
            $buku->save();
        }
    }
}