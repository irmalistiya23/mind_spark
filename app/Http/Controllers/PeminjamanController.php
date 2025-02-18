<?php
namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function borrow($id)
    {
        $buku = Buku::findOrFail($id);
    
        // Cek apakah buku sudah dipinjam oleh pengguna lain dan belum dikembalikan
        $existingBorrow = Peminjaman::where('BukuID', $buku->id)
                                    ->whereNull('TanggalPengembalian')
                                    ->first();
    
        if (!$existingBorrow) {
            // Jika buku belum dipinjam atau sudah dikembalikan, lakukan peminjaman
            Peminjaman::create([
                'UserID' => auth()->id(),
                'BukuID' => $buku->id,
                'TanggalPeminjaman' => now(),
                'StatusPeminjaman' => 'borrowed',
            ]);
        }
    
        return redirect()->route('bookshelf');  // Redirect ke bookshelf setelah borrow
    }
    

    public function return($id)
    {
        $buku = Buku::findOrFail($id);
        
        // Update status peminjaman menjadi dikembalikan
        $peminjaman = Peminjaman::where('BukuID', $buku->id)
            ->where('UserID', auth()->id())
            ->whereNull('TanggalPengembalian')
            ->first();

        if ($peminjaman) {
            $peminjaman->TanggalPengembalian = now();
            $peminjaman->StatusPeminjaman = 'returned';
            $peminjaman->save();
            
            $buku->status = 'available'; // Menandakan buku kembali tersedia
            $buku->save();
        }

        return redirect()->route('bookshelf');  // Redirect ke bookshelf setelah return
    }
    
    public function bookshelf()
    {
        $bukus = Buku::all();  // Ambil semua buku dari tabel buku
        return view('bookshelf', compact('bukus'));
    }
}
