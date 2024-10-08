<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Admin extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(): MorphOne
	{
		return $this->morphOne(User::class, 'authenticatable');
	}
}
