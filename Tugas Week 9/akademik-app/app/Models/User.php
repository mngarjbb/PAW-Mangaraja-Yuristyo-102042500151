<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ROLES = ['admin', 'dosen', 'mahasiswa'];

    // 'role' SENGAJA tidak masuk $fillable: role hanya boleh diset oleh sistem/admin
    // (lihat UserController & DatabaseSeeder), bukan dari input bebas pengguna.
    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function hasRole(string ...$roles): bool
    {
        return in_array($this->role, $roles, true);
    }

    public function nilais(): HasMany
    {
        return $this->hasMany(Nilai::class);
    }
}
