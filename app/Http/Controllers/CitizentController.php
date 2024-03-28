<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Citizents\StoreCitizentRequest;
use App\Http\Requests\User\Citizents\UpdateCitizentRequest;
use App\Models\Citizent;
use App\Models\User;
use App\Repositories\CitizentRepository;
use App\Repositories\EnvironmentalRepository;
use App\Utils\ResponseMessage;
use Exception;
use Illuminate\Http\Request;

class CitizentController extends Controller
{
    public function __construct(
        protected readonly CitizentRepository $citizentRepository,
        protected readonly EnvironmentalRepository $environmental,
        protected readonly User $user,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {     
        $users = $this->citizentRepository->findAll();
        
        return view('dashboard.users.citizents.index', compact('users'));
    }

    public function create()
    {     
        $environmentals = $this->environmental->findAll();
      
        return view('dashboard.users.citizents.create', compact('environmentals'));                          
    }

    public function show(Citizent $citizent)
    {                         
        return view('dashboard.users.citizents.detail', compact('citizent'));
    }

    public function edit(Citizent $citizent)
    {        
        $environmentals = $this->environmental->findAll();
                  
        return view('dashboard.users.citizents.edit', compact('citizent', 'environmentals'));
    }

    public function store(StoreCitizentRequest $request)
    {        
        try {
            $store = $this->citizentRepository->store($request->validated());

            if($store instanceof Citizent) {
                return redirect(route("citizents.index"))
                            ->with("success", $this->responseMessage->response('Pengguna'));
            } 
            throw new Exception;
        } catch (\Exception $e) {  
            logger($e->getMessage());

            return redirect(route("citizents.create"))->with("error", $this->responseMessage->response('pengguna', false));
        }
    }

    public function update(UpdateCitizentRequest $request, Citizent $citizent)
    {
        try { 
            $update = $this->citizentRepository->update($request->validated(), $citizent);

            if($update) {
                return redirect(route('citizents.index'))
                            ->with('success', $this->responseMessage->response('Pengguna', true, 'update'));
            }
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('citizents.edit', $citizent->id)->with('error', $this->responseMessage->response('pengguna', false, 'update'));
        }
    }

    public function destroy(Citizent $citizent)
    {
        try {
            $this->citizentRepository->delete($citizent);

            return redirect()->route('citizents.index')->with('success', $this->responseMessage->response('Pengguna', true, 'delete'));
        } catch (\Exception $e) {         
            return redirect()->route('citizents.index')->with('error', $this->responseMessage->response('pengguna', false, 'delete'));
        }
    }
}
