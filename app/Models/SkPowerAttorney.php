<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkPowerAttorney extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        "date_of_death" => "date"
    ];

    public function sk(): BelongsTo
    {
        return $this->belongsTo(Sk::class);
    }

    public function citizent(): BelongsTo
    {
        return $this->belongsTo(Citizent::class);
    }

    public function families(): HasMany
    {
        return $this->hasMany(SkPowerAttorneyFamily::class);
    }
}
