<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'number',
        'name',
        'nik',
        'email',
        'status_message',
        'status',
        'expired_date'
    ];

    /**
    * The attributes that should be cast.
    *
    * @var array
    */
    protected $casts = [
        'created_at' => 'datetime:M d, Y H:i',
        'expired_date' => 'datetime:M d, Y',
    ];
}
