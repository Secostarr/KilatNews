<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    protected $table = 'artikel_berita';
    protected $primaryKey = 'id_artikel';

    protected $fillable = [
        'nama_tag',
        'slug',
    ];
}
