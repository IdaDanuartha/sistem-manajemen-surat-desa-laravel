<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Repositories\ProfileRepository;
use App\Utils\ResponseMessage;
use Exception;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(
        protected readonly ProfileRepository $profileRepository,
        protected readonly ResponseMessage $responseMessage
    ) {}
    
    public function index()
    {             
        return view('dashboard.profile.index');
    }

    public function edit()
    {                                           
        return view('dashboard.profile.edit');
    }

    public function update(UpdateProfileRequest $request)
    {
        try {                     
            $update = $this->profileRepository->update($request->validated());

            if($update) return redirect(route('profile.index'))
                                ->with('success', $this->responseMessage->response('Profile', true, 'update'));
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('profile.edit')->with('error', $this->responseMessage->response('profile', false, 'update'));
        }
    }
}
