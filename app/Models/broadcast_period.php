<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class broadcast_period extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'order',
    ];
    
}
