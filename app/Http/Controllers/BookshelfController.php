<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;

class BookshelfController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;

        // Ambil buku yang masih dipinjam
        $borrowedBooks = Peminjaman::where('UserID', $userId)
            ->where('StatusPeminjaman', 'borrowed')
            ->with('buku')
            ->get();

        // Ambil buku yang sudah dikembalikan
        $returnedBooks = Peminjaman::where('UserID', $userId)
            ->where('StatusPeminjaman', 'returned')
            ->with('buku')
            ->get();

        return view('bookshelf', compact('borrowedBooks', 'returnedBooks'));
    }
}
