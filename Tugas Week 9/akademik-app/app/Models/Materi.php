<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Materi extends Model
{
    protected $table = 'materis';

    protected $fillable = ['title', 'course', 'description', 'user_id'];

    public function pengunggah(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
