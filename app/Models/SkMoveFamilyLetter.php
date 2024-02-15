<?php

namespace App\Models;

use App\Enums\RelationshipStatus2;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SkMoveFamilyLetter extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        "relationship_status" => RelationshipStatus2::class
    ];

    public function skMove(): BelongsTo
    {
        return $this->belongsTo(SkMoveLetter::class);
    }

    public function citizent(): BelongsTo
    {
        return $this->belongsTo(Citizent::class);
    }
}
