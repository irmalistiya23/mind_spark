<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;

class BookshelfController extends Controller
{
    public function index()
    {
        // Ambil data peminjaman berdasarkan user yang sedang login
        $peminjaman = Peminjaman::where('UserID', auth()->user()->id)
                                  ->with('buku')
                                  ->get();
        return view('bookshelf', compact('peminjaman'));
    }
}
