<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DieselPurchaseLetter extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        "start_expired_date" => "date",
        "end_expired_date" => "date",
    ];

    public function sk(): BelongsTo
    {
        return $this->belongsTo(Sk::class);
    }
}
