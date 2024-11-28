<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    protected $table = 'tag';
    protected $primaryKey = 'id_tag';

    protected $fillable = [
        'nama_tag',
        'slug',
    ];

    public function TagToArtikelTag()
    {
        return $this->hasMany(ArtikelTag::class, 'id_tag', 'id_tag');
    }

    public function artikelTag()
    {
        return $this->hasMany(tag::class, 'id_artikel');
    }
}
