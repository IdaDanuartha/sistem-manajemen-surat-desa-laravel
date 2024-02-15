<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Letter;
use App\Models\Sk;
use App\Utils\ResponseMessage;
use Illuminate\Http\Request;

class LetterHistoryController extends Controller
{
    public function __construct(
        protected readonly Sk $sk,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {     
        if(auth()->user()->role === Role::CITIZENT || auth()->user()->role === Role::SUPER_ADMIN) {
            $letters = $this->sk->where("status_by_village_head", 1)->get();
            return view('dashboard.letters.history', compact('letters'));
        } else {
            abort(404);
        }
    }

    public function show(Sk $sk)
    {    
        $find_sk = $this->sk->find($sk->id);

        if(isset($find_sk->skBirth)) {
            return redirect(route("letters.sk-birth.show", $find_sk->skBirth->id));
        } else if(isset($find_sk->skMarry)) {
            return redirect(route("letters.sk-marry.show", $find_sk->skMarry->id));
        } else if(isset($find_sk->skMaritalStatus)) {
            return redirect(route("letters.sk-marital-status.show", $find_sk->skMaritalStatus->id));
        } else if(isset($find_sk->sktu)) {
            return redirect(route("letters.sktu.show", $find_sk->sktu->id));
        } else if(isset($find_sk->sktm)) {
            return redirect(route("letters.sktm.show", $find_sk->sktm->id));
        } else if(isset($find_sk->skName)) {
            return redirect(route("letters.sk-name.show", $find_sk->skName->id));
        } else if(isset($find_sk->skSubsidizedHousing)) {
            return redirect(route("letters.sk-subsidized-housing.show", $find_sk->skSubsidizedHousing->id));
        } else if(isset($find_sk->skMove)) {
            return redirect(route("letters.sk-move.show", $find_sk->skMove->id));
        } else if(isset($find_sk->skTraveling)) {
            return redirect(route("letters.sk-traveling.show", $find_sk->skTraveling->id));
        } else if(isset($find_sk->skResidence)) {
            return redirect(route("letters.sk-residence.show", $find_sk->skResidence->id));
        } else if(isset($find_sk->skLandPrice)) {
            return redirect(route("letters.sk-land-price.show", $find_sk->skLandPrice->id));
        } else if(isset($find_sk->skParentIncome)) {
            return redirect(route("letters.sk-parent-income.show", $find_sk->skParentIncome->id));
        } else if(isset($find_sk->inheritanceGeneology)) {
            return redirect(route("letters.inheritance-geneology.show", $find_sk->inheritanceGeneology->id));
        } else if(isset($find_sk->skPowerAttorney)) {
            return redirect(route("letters.sk-power-attorney.show", $find_sk->skPowerAttorney->id));
        } else if(isset($find_sk->skHeir)) {
            return redirect(route("letters.sk-heir.show", $find_sk->skHeir->id));
        } else if(isset($find_sk->skInheritanceDistribution)) {
            return redirect(route("letters.sk-inheritance-distribution.show", $find_sk->skInheritanceDistribution->id));
        } else if(isset($find_sk->skDie)) {
            return redirect(route("letters.sk-die.show", $find_sk->skDie->id));
        } else if(isset($find_sk->parentalPermission)) {
            return redirect(route("letters.parental-permission.show", $find_sk->parentalPermission->id));
        } else if(isset($find_sk->skGrant)) {
            return redirect(route("letters.sk-grant.show", $find_sk->skGrant->id));
        } else if(isset($find_sk->dieselPurchase)) {
            return redirect(route("letters.diesel-purchase.show", $find_sk->dieselPurchase->id));
        } else if(isset($find_sk->skDomicile)) {
            return redirect(route("letters.sk-domicile.show", $find_sk->skDomicile->id));
        } else if(isset($find_sk->registrationForm)) {
            return redirect(route("letters.registration-form.show", $find_sk->registrationForm->id));
        } else if(isset($find_sk->treeFelling)) {
            return redirect(route("letters.tree-felling.show", $find_sk->treeFelling->id));
        } else {
            return abort(404);
        }
    }
}
