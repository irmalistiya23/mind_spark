<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'bukus';
    
    protected $fillable = [
        'CoverBuku',
        'NamaBuku',
        'deskripsi',
        'penerbit',
        'penulis',
        'tanggal_terbit'
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

    // Relasi dengan kategori_bukus
    public function kategoriBukus()
    {
        return $this->hasMany(KategoriBuku::class, 'BukuID', 'id');
    }

    // Relasi langsung dengan kategoris
    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'kategori_bukus', 'BukuID', 'KategoriID');
    }
}
