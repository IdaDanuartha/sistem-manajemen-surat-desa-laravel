<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Repositories\EnvironmentalRepository;
use App\Repositories\ProfileRepository;
use App\Utils\ResponseMessage;
use Exception;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(
        protected readonly ProfileRepository $profileRepository,
        protected readonly EnvironmentalRepository $environmental,
        protected readonly ResponseMessage $responseMessage
    ) {}
    
    public function index()
    {             
        return view('dashboard.profile.index');
    }

    public function edit()
    {             
        $environmentals = $this->environmental->findAll();

        return view('dashboard.profile.edit', compact('environmentals'));
    }

    public function update(UpdateProfileRequest $request)
    {
        try {    
            $update = $this->profileRepository->update($request->validated());

            if($update == true) return redirect(route('profile.index'))
                                ->with('success', $this->responseMessage->response('Profil', true, 'update'));
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('profile.edit')->with('error', $this->responseMessage->response('profil', false, 'update'));
        }
    }
}
