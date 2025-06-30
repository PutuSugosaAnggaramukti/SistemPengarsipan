<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tahun2022 extends Model
{   
    use SoftDeletes;
    protected $fillable = [
    'original_name',
    'generated_name',
    'year',
    'filepath2022', // ✅ must be here
    ];
}
