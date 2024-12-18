<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $table = 'kategori_berita';
    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
        'slug',
        'urutan',
        'judul', 'konten', 'media_utama', 'kategori_id', 'is_trending', 'is_highlight',
    ];

    public function artikels()
    {
        return $this->hasMany(artikel::class, 'id_kategori', 'id_kategori');
    }
}


