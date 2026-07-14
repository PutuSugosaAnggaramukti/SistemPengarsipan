<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    protected $table = 'user';
    protected $primaryKey = 'npp';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'npp',
        'username',
        'password',
        'nama_user',
        'role',
        'id_divisi',
        'force_change_password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'force_change_password' => 'boolean',
        ];
    }
}
