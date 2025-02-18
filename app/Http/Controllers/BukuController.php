<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    
    public function show($id)
    {
        // Ambil data buku beserta relasinya (kategori dan ulasan)
        $buku = Buku::with(['kategoris', 'ulasans.user'])->findOrFail($id);
        
        // Hitung rata-rata rating
        $averageRating = $buku->ulasans->avg('Rating') ?? 0;

         // Ambil buku lain kecuali buku yang sedang ditampilkan
         $otherBooks = Buku::where('id', '!=', $id)->get();
                 // Cek apakah buku sudah dipinjam oleh user (status = borrowed)
        $isBorrowed = Peminjaman::where('UserID', auth()->user()->id)
        ->where('BukuID', $buku->id)
        ->where('StatusPeminjaman', 'borrowed')
        ->exists();
         
        return view('buku', compact('buku', 'averageRating', 'otherBooks', 'isBorrowed')); 
    }
    
}