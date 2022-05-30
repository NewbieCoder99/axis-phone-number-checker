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
}
