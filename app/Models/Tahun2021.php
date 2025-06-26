<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tahun2021 extends Model
{
    protected $fillable = [
    'original_name',
    'generated_name',
    'year',
    'filepath2021', // ✅ must be here
    ];
}
