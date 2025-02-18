<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
=======
>>>>>>> 97ea9b4 (belum uji coba tpi udh di Inisialisasi proyek dan setup Chatify)
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

<<<<<<< HEAD
    protected $fillable = ['nis', 'nama', 'email', 'alamat', 'password', 'role'];
=======
    protected $fillable = [
        'nis', 
        'nama',
        'email', 
        'alamat', 
        'password', 
        'foto', 
        'role'];
>>>>>>> 97ea9b4 (belum uji coba tpi udh di Inisialisasi proyek dan setup Chatify)

    public function favorits()
    {
        return $this->hasMany(Favorit::class, 'UserID');
    }

    public function ulasans()
    {
        return $this->hasMany(Ulasan::class, 'UserID');
    }

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'UserID');
    }
<<<<<<< HEAD
=======

    public function getFotoUrlAttribute()
    {
        return $this->foto ? asset('storage/' . $this->foto) : asset('assets/img/avatar.png');
    }

    
     //relasi ke model favorit
    public function favorites()
    {
        return $this->hasMany(Favorit::class, 'UserID');
    }
 
    public function hasFavorited($bukuId)
    {
        return $this->favorites()->where('BukuID', $bukuId)->exists();
    }
>>>>>>> 97ea9b4 (belum uji coba tpi udh di Inisialisasi proyek dan setup Chatify)
}
