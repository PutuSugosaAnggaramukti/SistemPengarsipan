<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tahun2023 extends Model
{
    protected $fillable = [
    'original_name',
    'generated_name',
    'year',
    'filepath2023', // ✅ must be here
    ];
}
