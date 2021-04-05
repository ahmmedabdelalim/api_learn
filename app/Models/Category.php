<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categorys';

    protected $fillable=[
        'id',
        'name_ar',
        'name_en',
        'created_at',
        'updated_at',
    ];

    protected $hidden = ['created_at','updated_at'];


    public function scopeSelection($query)
    {
        return $query->select('id','name_' . app()->getLocale() . ' as name');
    }

}
