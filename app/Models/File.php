<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;
    protected $fillable = [
    'original_name',
    'generated_name',
    'year',
    'file_path', // ✅ must be here
    ];
}
