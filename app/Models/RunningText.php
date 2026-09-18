<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class RunningText extends Model {
    use HasUuids;
    protected $fillable = ['text', 'is_active', 'created_by'];
    protected function casts(): array { return ['is_active' => 'boolean']; }
    public function creator() { return $this->belongsTo(User::class, 'created_by'); }
}
