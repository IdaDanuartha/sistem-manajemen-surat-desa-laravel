<?php

namespace App\Models;

use App\Enums\SktmType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SktmLetter extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        "sktm_type" => SktmType::class
    ];

    public function sk(): BelongsTo
    {
        return $this->belongsTo(Sk::class);
    }

    public function sktmSchool(): HasOne
    {
        return $this->hasOne(SktmSchoolLetter::class);
    }
}
