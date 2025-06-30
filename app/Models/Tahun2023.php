<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tahun2023 extends Model
{
    use SoftDeletes;
    protected $fillable = [
    'original_name',
    'generated_name',
    'year',
    'filepath2023', // ✅ must be here
    ];
}
