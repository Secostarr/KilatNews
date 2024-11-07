<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pengaturan extends Model
{
    protected $table = 'pengaturan_situs';
    protected $primaryKey = 'id_pengaturan';

    protected $fillable = [
        'nama_situs',
        'logo',
        'deskripsi_singkat',
        'kontak_email',
        'social_media_links',
    ];
}
