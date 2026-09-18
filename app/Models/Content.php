<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Content extends Model {
    use HasUuids;
    protected $fillable = ['title', 'media_url', 'media_type', 'duration_seconds', 'start_date', 'end_date', 'status', 'notes', 'submitted_by', 'approved_by'];
    protected function casts(): array {
        return ['start_date' => 'datetime', 'end_date' => 'datetime', 'duration_seconds' => 'integer'];
    }
    public function submitter() { return $this->belongsTo(User::class, 'submitted_by'); }
    public function approver() { return $this->belongsTo(User::class, 'approved_by'); }
}
