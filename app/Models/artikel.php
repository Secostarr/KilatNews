<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class artikel extends Model
{
    protected $table = 'artikel_berita';
    protected $primaryKey = 'id_artikel';

    protected $fillable = [
        'judul',
        'konten',
        'slug',
        'id_user',
        'id_kategori',
        'media_utama',
        'status_publikasi',
        'highlight',
        'lokasi',
        'viewer_count',
        'trending',
    ];
}
