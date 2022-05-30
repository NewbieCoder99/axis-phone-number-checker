<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CacheFile extends Model
{

    use HasFactory;

    protected $fillable = [
        'cache_name',
        'cache_data'
    ];

}
