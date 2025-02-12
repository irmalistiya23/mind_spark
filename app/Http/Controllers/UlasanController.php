<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'BukuID' => 'required|exists:bukus,id',
            'Rating' => 'required|integer|min:1|max:5',
            'Ulasan' => 'required|string|min:10'
        ]);

        Ulasan::create([
            'UserID' => auth()->id(),
            'BukuID' => $request->BukuID,
            'Rating' => $request->Rating,
            'Ulasan' => $request->Ulasan
        ]);

        return back()->with('success', 'Review added successfully!');
    }
} 