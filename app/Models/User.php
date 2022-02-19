<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail , CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        //       'is_admin' => 'boolean'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function oldestPost()
    {
        return $this->hasOne(Post::class)->oldestOfMany();
    }


    public function latestPost()
    {
        return $this->hasOne(Post::class)->latestOfMany();
    }

    public function currentPost()
    {
        return $this->hasOne(Post::class)->ofMany([
            'created_at' => 'max',
            'id' => 'max'
        ], function ($query) {
            $query->where('created_at', '<', now());
        });
    }

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getNameEmailAttribute()
    {
        return "{$this->name}  {$this->email}";
    }

    public function setNameUpperAttribute($value)
    {
        $this->attributes['name_upper'] = Str::upper($value);
    }

    /**
     * Send a password reset notification to the user.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $url = 'https://example.com/reset-password?token=' . $token;

        $this->notify(new ResetPasswordNotification($url));
    }
}
