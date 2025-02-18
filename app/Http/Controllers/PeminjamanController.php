<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Peminjaman;

class PeminjamanController extends Controller
{
    public function borrow($id)
    {
        // Cek ulang jika buku sudah dipinjam oleh user
        $exists = Peminjaman::where('UserID', auth()->user()->id)
                    ->where('BukuID', $id)
                    ->where('StatusPeminjaman', 'borrowed')
                    ->exists();
                    
        if($exists){
            return response()->json([
                'success' => false,
                'message' => 'You have already borrowed this book.'
            ]);
        }
        
        // Simpan data peminjaman baru
        $peminjaman = new Peminjaman();
        $peminjaman->UserID = auth()->user()->id;
        $peminjaman->BukuID = $id;
        $peminjaman->StatusPeminjaman = 'borrowed';
        $peminjaman->TanggalPeminjaman = now();
        $peminjaman->save();

        return response()->json(['success' => true]);
    }
}
