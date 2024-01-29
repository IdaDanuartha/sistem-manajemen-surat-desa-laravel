<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Role;
use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
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
    protected $guarded = ['id'];

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
        'password' => 'hashed',
        'role' => Role::class,
        'status' => UserStatus::class
    ];

    public function isAdmin(): bool
    {
        return $this->role === Role::ADMIN;
    }

    public function isVillageHead(): bool
    {
        return $this->role === Role::VILLAGE_HEAD;
    }

    public function isEnvironmentalHead(): bool
    {
        return $this->role === Role::ENVIRONMENTAL_HEAD;
    }

    public function isSectionHead(): bool
    {
        return $this->role === Role::SECTION_HEAD;
    }

    public function isCitizent(): bool
    {
        return $this->role === Role::CITIZENT;
    }

    public function disable(): bool
    {
        return $this->update(['role' => UserStatus::NONACTIVE]);
    }

    public function activate(): bool
    {
        return $this->update(['role' => UserStatus::ACTIVE]);
    }

    public function disabled(): bool
    {
        return $this->status === UserStatus::NONACTIVE;
    }

    public function isActive(): bool
    {
        return !$this->disabled();
    }

    public function authenticatable(): MorphTo
    {
        return $this->morphTo();
    }
}
