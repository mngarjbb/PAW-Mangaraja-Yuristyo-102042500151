<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nilai extends Model
{
    protected $table = 'nilais';

    protected $fillable = ['user_id', 'course', 'score'];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getGradeAttribute(): string
    {
        return match (true) {
            $this->score >= 85 => 'A',
            $this->score >= 70 => 'B',
            $this->score >= 55 => 'C',
            $this->score >= 40 => 'D',
            default => 'E',
        };
    }
}
