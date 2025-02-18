<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Peminjaman;

class PeminjamanController extends Controller
{
    public function borrow($id)
    {
        // Temukan buku berdasarkan ID
        $buku = Buku::findOrFail($id);

        // Buat record peminjaman baru
        $peminjaman = new Peminjaman();
        $peminjaman->UserID = auth()->user()->id; // pastikan user sudah login
        $peminjaman->BukuID = $buku->id;
        $peminjaman->StatusPeminjaman = 'borrowed';
        $peminjaman->TanggalPeminjaman = now(); // waktu peminjaman saat ini
        // TanggalPengembalian dibiarkan default ('0000-00-00 00:00:00')
        $peminjaman->save();

        // Redirect ke halaman bookshelf dengan pesan sukses
        return response()->json(['success' => true]);    }
}
