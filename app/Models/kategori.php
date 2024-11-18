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
    ];

    public function artikels()
    {
        return $this->hasMany(Artikel::class, 'id_kategori');
    }
}
