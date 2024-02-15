<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SkInheritanceDistributionFamily extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function skInheritanceDistribution(): BelongsTo
    {
        return $this->belongsTo(SkInheritanceDistribution::class);
    }

    public function citizent(): BelongsTo
    {
        return $this->belongsTo(Citizent::class);
    }
}
