<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tahun2025 extends Model
{
    protected $fillable = [
    'original_name',
    'generated_name',
    'year',
    'filepath2025', // ✅ must be here
    ];
}
