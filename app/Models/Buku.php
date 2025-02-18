<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'bukus';
    protected $primaryKey = 'id';

    protected $fillable = [
        'NamaBuku',
        'penulis',
        'penerbit',
        'deskripsi',
        'CoverBuku'
    ];

    // Relasi dengan kategori
    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'kategori_bukus', 'BukuID', 'KategoriID');
    }

    // Relasi dengan ulasan
    public function ulasans()
    {
        return $this->hasMany(Ulasan::class, 'BukuID', 'id');
    }

    // Method untuk menghitung rata-rata rating
    public function getAverageRatingAttribute()
    {
        return $this->ulasans()->avg('Rating') ?: 0;
    }

    // Method untuk mendapatkan jumlah ulasan
    public function getReviewsCountAttribute()
    {
        return $this->ulasans()->count();
    }

    
    //relasi ke model favorit
    public function favorites()
    {
        return $this->hasMany(Favorit::class, 'BukuID');
    }

// Relasi ke model Peminjaman
public function peminjaman()
{
    return $this->hasMany(Peminjaman::class, 'BukuID');
}

}