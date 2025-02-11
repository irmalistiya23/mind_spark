<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManageController extends Controller
{
    public function index()
    {
        $users = User::all();
        $books = Buku::with('kategoris')->get();
        return view('manage', compact('users', 'books'));
    }

    // User Management
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('manage')->with('success', 'User berhasil dihapus');
    }

    // Book Management
    public function create()
    {
        $kategoris = Kategori::all();
        return view('books.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'NamaBuku' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'deskripsi' => 'required',
            'CoverBuku' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'kategoris' => 'required|array',
        ]);

        $imageName = time().'.'.$request->CoverBuku->extension();
        $request->CoverBuku->storeAs('public/cover_buku', $imageName);

        $buku = Buku::create([
            'NamaBuku' => $request->NamaBuku,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'deskripsi' => $request->deskripsi,
            'CoverBuku' => $imageName,
            'tanggal_terbit' => now(),
        ]);

        $buku->kategoris()->attach($request->kategoris);

        return redirect()->route('manage')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    public function destroyBook($id)
    {
        $book = Buku::findOrFail($id);
        if($book->CoverBuku) {
            Storage::delete('public/cover_buku/' . $book->CoverBuku);
        }
        $book->kategoris()->detach(); // Hapus relasi dengan kategori
        $book->delete();
        return redirect()->route('manage')->with('success', 'Buku berhasil dihapus');
    }
}