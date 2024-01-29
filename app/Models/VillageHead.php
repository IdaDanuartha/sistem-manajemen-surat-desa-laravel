<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class VillageHead extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(): MorphOne
	{
		return $this->morphOne(User::class, 'authenticatable');
	}
    
    public function citizent(): BelongsTo
    {
        return $this->belongsTo(Citizent::class);
    }
}
