<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tahun2024 extends Model
{
    protected $fillable = [
    'original_name',
    'generated_name',
    'year',
    'filepath2024', // ✅ must be here
    ];
}
