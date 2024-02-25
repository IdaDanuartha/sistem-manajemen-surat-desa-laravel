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
        return $this->belongsTo(Citizent::class);
    }

    public function environmentalHead(): BelongsTo
    {
        return $this->belongsTo(Citizent::class);
    }

    public function sectionHead(): BelongsTo
    {
        return $this->belongsTo(Citizent::class);
    }  

    public function skBirth(): HasOne
    {
        return $this->hasOne(SkBirthLetter::class);
    }
    public function skMarry(): HasOne
    {
        return $this->hasOne(SkMarryLetter::class);
    }
    public function skMaritalStatus(): HasOne
    {
        return $this->hasOne(SkMaritalStatusLetter::class);
    }
    public function sktu(): HasOne
    {
        return $this->hasOne(SktuLetter::class);
    }
    public function sktm(): HasOne
    {
        return $this->hasOne(SktmLetter::class);
    }
    public function skName(): HasOne
    {
        return $this->hasOne(SkNameLetter::class);
    }
    public function skSubsidizedHousing(): HasOne
    {
        return $this->hasOne(SkSubsidizedHousingLetter::class);
    }
    public function skMove(): HasOne
    {
        return $this->hasOne(SkMoveLetter::class);
    }
    public function skTraveling(): HasOne
    {
        return $this->hasOne(SkTravelingLetter::class);
    }
    public function skResidence(): HasOne
    {
        return $this->hasOne(SkResidenceLetter::class);
    }
    public function skLandPrice(): HasOne
    {
        return $this->hasOne(SkLandPriceLetter::class);
    }
    public function skParentIncome(): HasOne
    {
        return $this->hasOne(SkParentIncomeLetter::class);
    }
    public function inheritanceGeneology(): HasOne
    {
        return $this->hasOne(InheritanceGeneology::class);
    }
    public function skPowerAttorney(): HasOne
    {
        return $this->hasOne(SkPowerAttorney::class);
    }
    public function skHeir(): HasOne
    {
        return $this->hasOne(SkHeir::class);
    }
    public function skInheritanceDistribution(): HasOne
    {
        return $this->hasOne(SkInheritanceDistribution::class);
    }
    public function skDie(): HasOne
    {
        return $this->hasOne(SkDieLetter::class);
    }
    public function parentalPermission(): HasOne
    {
        return $this->hasOne(ParentalPermissionLetter::class);
    }
    public function skGrant(): HasOne
    {
        return $this->hasOne(SkGrantLetter::class);
    }
    public function dieselPurchase(): HasOne
    {
        return $this->hasOne(DieselPurchaseLetter::class);
    }
    public function skDomicile(): HasOne
    {
        return $this->hasOne(SkDomicileLetter::class);
    }
    public function registrationForm(): HasOne
    {
        return $this->hasOne(RegistrationFormLetter::class);
    }
    public function treeFelling(): HasOne
    {
        return $this->hasOne(TreeFellingLetter::class);
    }
}
