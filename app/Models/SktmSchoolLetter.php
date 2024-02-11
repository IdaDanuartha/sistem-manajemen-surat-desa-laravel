<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SktmSchoolLetter extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function sktm(): BelongsTo
    {
        return $this->belongsTo(SktmLetter::class);
    }
}
