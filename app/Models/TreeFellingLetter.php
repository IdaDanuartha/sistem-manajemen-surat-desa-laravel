<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TreeFellingLetter extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function sk(): BelongsTo
    {
        return $this->belongsTo(Sk::class);
    }
}
