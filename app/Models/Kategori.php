<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';
    protected $primaryKey = 'id';
    
    protected $fillable = ['NamaKategori'];

    // Relasi dengan tabel kategori_bukus
    public function kategoriBukus()
    {
        return $this->hasMany(KategoriBuku::class, 'KategoriID', 'id');
    }

    // Relasi dengan buku melalui kategori_bukus
    public function bukus()
    {
        return $this->belongsToMany(Buku::class, 'kategori_bukus', 'KategoriID', 'BukuID');
    }
}
