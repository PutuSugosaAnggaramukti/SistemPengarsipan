<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tahun2020 extends Model
{
    protected $fillable = [
    'original_name',
    'generated_name',
    'year',
    'filepath', // ✅ must be here
    ];
}
