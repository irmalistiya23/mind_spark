<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{

    public function borrow($id)
    {
        $buku = Buku::findOrFail($id);
    
        // Cek apakah buku sedang dipinjam
        $existingLoan = Peminjaman::where('BukuID', $id)
            ->where('UserID', Auth::id())
            ->where('StatusPeminjaman', 'dipinjam')
            ->first();
    
        if ($existingLoan) {
            return back()->with('error', 'Buku ini sedang Anda pinjam.');
        }
    
        // Buat entri peminjaman baru
        Peminjaman::create([
            'UserID' => Auth::id(),
            'BukuID' => $buku->id,
            'StatusPeminjaman' => 'dipinjam',
        ]);
    
        return redirect()->route('bookshelf')->with('success', 'Buku berhasil dipinjam!');
    }
    
    public function return($id)
    {
        $loan = Peminjaman::where('BukuID', $id)
            ->where('UserID', Auth::id())
            ->where('StatusPeminjaman', 'dipinjam')
            ->firstOrFail();
    
        // Perbarui status pengembalian
        $loan->update([
            'TanggalPengembalian' => now(),
            'StatusPeminjaman' => 'dikembalikan',
        ]);
    
        return redirect()->route('bookshelf')->with('success', 'Buku berhasil dikembalikan!');
    }
    

    public function index()
    {
        // Ambil buku yang sedang dipinjam oleh user
        $booksOnLoan = Peminjaman::where('UserID', Auth::id())
                                ->where('StatusPeminjaman', 'dipinjam')
                                ->with('buku') // Ambil data buku terkait
                                ->get();
        
        // Ambil riwayat buku yang sudah dikembalikan
        $returnedBooks = Peminjaman::where('UserID', Auth::id())
                                ->where('StatusPeminjaman', 'dikembalikan')
                                ->with('buku')
                                ->get();
    
        // Kirim data ke view
        return view('bookshelf', compact('booksOnLoan', 'returnedBooks'));
    }
    


    
}
