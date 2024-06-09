<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class education extends Model
{
    use HasFactory;

    // テーブル名を明示的に指定する場合
    protected $table = 'educations';

    protected $fillable = [
        'title',
        'body',
        'body_html',
        'large_kbn',
        'middle_kbn',
        'small_kbn',
        'order',
    ];
}
