<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    protected $table = 'documents';
    protected $primaryKey = 'id_document';

    protected $fillable = [
        'nomor',
        'tanggal',
        'tahun',
        'nama_document',
        'direktory_document',
        'npp',
    ];

    public function getOriginalNameAttribute()
    {
        return $this->nama_document;
    }

    public function getYearAttribute()
    {
        return $this->tahun;
    }

    public function getFilePathAttribute()
    {
        return $this->direktory_document;
    }

    public function getGeneratedNameAttribute()
    {
        return $this->nama_document;
    }
}
