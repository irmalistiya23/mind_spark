<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Buku;
use App\Models\User;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'UserID',
        'BukuID',
        'TanggalPeminjaman',
        'TanggalPengembalian',
        'StatusPeminjaman',
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'BukuID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }
}
