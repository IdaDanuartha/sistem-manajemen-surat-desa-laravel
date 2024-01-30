<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Letter extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        "date" => "date"
    ];

    public function approvedByVillageHead()
    {
        return $this->where('approved_by_village_head', 1)->first();
    }

    public function citizent(): BelongsTo
    {
        return $this->belongsTo(Citizent::class);
    }

    public function villageHead(): BelongsTo
    {
        return $this->belongsTo(VillageHead::class);
    }

    public function environmentalHead(): BelongsTo
    {
        return $this->belongsTo(EnvironmentalHead::class);
    }

    public function sectionHead(): BelongsTo
    {
        return $this->belongsTo(SectionHead::class);
    }  
}
