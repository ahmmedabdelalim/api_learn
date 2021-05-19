<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;
    protected $table = 'agencys';
    protected $fillable = [
        'id',
        'name',
        'email',
        'created_at',
        'updated_at',
        'password',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
