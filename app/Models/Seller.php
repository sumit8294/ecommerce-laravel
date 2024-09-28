<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'password',
        'email',
        'address',
        'gst_number',
        'profile'
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
