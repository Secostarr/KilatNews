<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class komentar extends Model
{
    protected $table = 'komentar';
    protected $primaryKey = 'id_komentar';

    protected $fillable = [
        'id_artikel',
        'id_user',
        'isi_komentar',
        'replay_to',
    ];

    public function artikel()
    {
        return $this->belongsTo(Artikel::class, 'id_artikel');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    




}
