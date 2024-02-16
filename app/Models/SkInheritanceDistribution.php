<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SkInheritanceDistribution extends Model
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
    
    public function families(): HasMany
    {
        return $this->hasMany(SkInheritanceDistributionFamily::class);
    }
}
