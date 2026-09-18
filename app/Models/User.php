<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use HasUuids;
    protected $fillable = ['name', 'email', 'password', 'role'];
    protected $hidden = ['password'];
    protected function casts(): array { return ['password' => 'hashed']; }
    public function isAdmin(): bool { return $this->role === 'admin'; }
    public function isGuru(): bool { return $this->role === 'guru'; }
    public function isSiswa(): bool { return $this->role === 'siswa'; }
}
