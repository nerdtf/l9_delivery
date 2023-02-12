<?php

namespace App\Models;

use App\Enums\ClientStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $fillable = [
        "first_name",
        "last_name",
        "image",
        "address",
        "email",
        "phone"
    ];

    protected $casts = [
        'status' => ClientStatus::class
    ];

    protected $hidden = ["password"];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
