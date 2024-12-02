<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SosialMedia extends Model
{
    use HasFactory;

    protected $table = 'social_media';
    protected $primaryKey = 'id_social_media';

    protected $fillable = [
        'id_user',
        'username_facebook',
        'username_instagram',
        'url_facebook',
        'url_instagram',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
