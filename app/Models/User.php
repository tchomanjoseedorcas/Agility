<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'contact',
        'photo',
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
        'password' => 'hashed',
    ];

    public function administrator(): HasOne
    {
        return $this->hasOne(Administrator::class);
    }

    public function projectHolder(): HasOne
    {
        return $this->hasOne(ProjectHolder::class);
    }

    public function getRoleAttribute(): Role
    {
        return $this->roles()->first();
    }

    public function project(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function task(): HasMany
    {
        return $this->hasMany(Task::class, 'affected_to');
    }

    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class, 'created_by');
    }
}
