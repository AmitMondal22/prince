<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];



    /**
     * Interact with the user's first name.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    /**
     * The `type()` function returns an `Attribute` object with a custom cast for the `type` attribute
     * of the `User` model.
     *
     * @return Attribute The code is returning an instance of the `Attribute` class.
     */
    protected function type(): Attribute
    {
       /* The code `return new Attribute(get: fn () =>  ["admin", "user1", "user2"][])` is
       defining a custom cast for the `type` attribute of the `User` model. */
        return new Attribute(
            get: fn ($value) =>  ["admin", "user1", "user2"][$value],
        );
    }
}
