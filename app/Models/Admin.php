<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin  extends Authenticatable implements JWTSubject
{
    use HasFactory;
    //protected $guard = 'admin-api';

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











    /////////////////

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
