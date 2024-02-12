<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SkDomicileLetter extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function sk(): BelongsTo
    {
        return $this->belongsTo(Sk::class);
    }
    public function citizent(): BelongsTo
    {
        return $this->belongsTo(Citizent::class);
    }
}
