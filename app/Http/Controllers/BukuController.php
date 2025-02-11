<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function show($id)
    {
        $buku = Buku::with(['kategoris', 'ulasans.user'])->findOrFail($id);
        return view('buku', compact('buku'));
    }
} 