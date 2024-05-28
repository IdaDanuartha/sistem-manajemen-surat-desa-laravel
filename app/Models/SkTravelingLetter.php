<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkTravelingLetter extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function sk(): BelongsTo
    {
        return $this->belongsTo(Sk::class);
    }
}
