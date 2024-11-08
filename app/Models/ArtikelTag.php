<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtikelTag extends Model
{
    protected $table = 'artikel_tag';
    protected $primaryKey = 'id_artikel';

    protected $fillable = [
        'id_tag',
    ];
}
