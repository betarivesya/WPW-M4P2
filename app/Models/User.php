<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'email',
    'email_verified_at',
    'password',
    'first_name',
    'last_name',
    'active',
    'status',
    'role',
    'age',
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

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
            'active' => 'boolean',
            'age' => 'integer',
        ];
    }

    // One to One
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // One to Many
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Many to Many
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // Mutator
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // Accessor
    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
