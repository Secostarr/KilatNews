<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class likes extends Model
{
    protected $table = 'likes';
    protected $primaryKey = 'id_likes';

    protected $fillable = [
        'id_artikel',
        'id_user',
    ];
}
