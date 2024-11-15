<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtikelTag extends Model
{
    protected $table = 'artikel_tag';
    protected $fillable = [
        'id_tag',
        'id_artikel',
    ];

    public $primaryKey = null;
    public $incrementing = false;

    public function artikel()
    {
        return $this->belongsTo(artikel::class, 'id_artikel', 'id_artikel');
    }

    public function tag()
    {
        return $this->belongsTo(tag::class, 'id_tag', 'id_tag');
    }
}
