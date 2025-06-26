<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tahun2022 extends Model
{
    protected $fillable = [
    'original_name',
    'generated_name',
    'year',
    'filepath2022', // ✅ must be here
    ];
}
