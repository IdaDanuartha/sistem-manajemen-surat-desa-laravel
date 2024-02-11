<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
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
