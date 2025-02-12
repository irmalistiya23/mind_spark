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
}