<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'penulis',
        'gambar',
        'deskripsi',
        'kategori_id'
    ];

    public function favorits()
    {
        return $this->hasMany(Favorit::class, 'BukuID');
    }

    public function ulasans()
    {
        return $this->hasMany(Ulasan::class, 'BukuID');
    }

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'BukuID');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'KategoriID');
    }
}
