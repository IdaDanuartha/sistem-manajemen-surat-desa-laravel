<?php

namespace App\Models;

use App\Enums\RelationshipStatus2;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SkPowerAttorneyFamily extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        "relationship_status" => RelationshipStatus2::class
    ];

    public function skPowerAttorney(): BelongsTo
    {
        return $this->belongsTo(SkPowerAttorney::class);
    }

    public function citizent(): BelongsTo
    {
        return $this->belongsTo(Citizent::class);
    }
}
