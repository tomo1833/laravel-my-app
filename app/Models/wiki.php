<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wiki extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
    ];
    
}
