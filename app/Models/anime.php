<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class anime extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'path',
        'body',
        'genre',
        'title_kana',
        'production_company',
        'season_1_opening',
        'season_1_ending',
        'season_2_opening',
        'season_2_ending',
        'broadcast_period',
    ];
}
