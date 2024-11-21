<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class artikel extends Model
{
    protected $table = 'artikel';
    protected $primaryKey = 'id_artikel';

    protected $fillable = [
        'judul',
        'konten',
        'slug',
        'tanggal_publikasi',
        'id_user',
        'id_kategori',
        'id_tag',
        'media_utama',
        'status_publikasi',
        'highlight',
        'lokasi',
        'viewer_count',
        'like_count',
        'comment_count',
        'trending',
    ];

    public function ArtikelToTag()
    {
        return $this->hasOne(tag::class, 'id_tag', 'id_tag');
    }

    public function ArtikelToArtikelTag()
    {
        return $this->hasOne(ArtikelTag::class, 'id_artikel', 'id_artikel');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
