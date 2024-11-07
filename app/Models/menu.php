<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id_menu';

    protected $fillable = [
        'name',
        'url',
        'id_parent',
        'order',
        'status',  
    ];
}
