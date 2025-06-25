<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
    'original_name',
    'generated_name',
    'year',
    'file_path', // ✅ must be here
    ];
}
