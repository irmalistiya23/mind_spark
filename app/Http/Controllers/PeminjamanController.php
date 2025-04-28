<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        if ($exists) {
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

    public function update(Request $request, $id)
    {
        if (!in_array(auth()->user()->role, ['petugas', 'administrator'])) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.']);
        }
        
        $request->validate([
            'StatusPeminjaman' => 'required|in:borrowed,returned'
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->StatusPeminjaman = $request->StatusPeminjaman;

        // Jika status dikembalikan, catat waktu pengembalian
        if ($request->StatusPeminjaman === 'returned') {
            $peminjaman->TanggalPengembalian = now();
        }

        $peminjaman->save();

        return redirect()->route('loaning')->with('success', 'Status updated successfully.');
    }

    public function showForm($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        return view('peminjaman.edit', compact('peminjaman'));
    }
    public function index()
    {
        $peminjaman = Peminjaman::with(['user', 'buku'])->get();
        return view('loaning', compact('peminjaman'));
    }
    

}