<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;
    const GENDER_NONE = 3;

    private static $defaultPassword = '12345';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static function getDefaultPassword()
    {
        return User::$defaultPassword;
    }

    public static function setDefaultPassword(string $newPassword) {
        User::$defaultPassword == $newPassword;
    }

    public static function getGenders()
    {
        return [
            User::GENDER_MALE => 'male',
            User::GENDER_FEMALE => 'female',
            User::GENDER_NONE => 'not specified',
        ];
    }

    public function getGenderTitleAttribute()
    {
        return User::getGenders()[$this->gender];
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
