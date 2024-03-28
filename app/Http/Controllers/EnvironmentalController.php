<?php

namespace App\Http\Controllers;

use App\Models\Environmental;
use App\Http\Controllers\Controller;
use App\Http\Requests\Environmental\StoreEnvironmentalRequest;
use App\Http\Requests\Environmental\UpdateEnvironmentalRequest;
use App\Repositories\EnvironmentalRepository;
use App\Utils\ResponseMessage;
use Exception;
use Illuminate\Http\Request;

class EnvironmentalController extends Controller
{
    public function __construct(
        protected readonly EnvironmentalRepository $environmental,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {     
        $environmentals = $this->environmental->findAll();
        
        return view('dashboard.environmentals.index', compact('environmentals'));
    }

    public function create()
    {           
        $environmentals = $this->environmental->findAll();

        return view('dashboard.environmentals.create', compact('environmentals'));                          
    }

    public function show(Environmental $environmental)
    {                         
        return view('dashboard.environmentals.detail', compact('environmental'));
    }

    public function edit(Environmental $environmental)
    {                       
        $environmentals = $this->environmental->findAll();
   
        return view('dashboard.environmentals.edit', compact('environmental', 'environmentals'));
    }

    public function store(StoreEnvironmentalRequest $request)
    {        
        try {
            $store = $this->environmental->store($request->validated());

            if($store instanceof Environmental) {
                return redirect(route("environmentals.index"))
                            ->with("success", $this->responseMessage->response('Lingkungan'));
            } 
            dd($store);
            throw new Exception();
        } catch (\Exception $e) {  
            logger($e->getMessage());

            return redirect(route("environmentals.create"))->with("error", $this->responseMessage->response('lingkungan', false));
        }
    }

    public function update(UpdateEnvironmentalRequest $request, Environmental $environmental)
    {
        try { 
            $update = $this->environmental->update($request->validated(), $environmental);

            if($update) {
                return redirect(route('environmentals.index'))
                            ->with('success', $this->responseMessage->response('Lingkungan', true, 'update'));
            }
            throw new Exception;
        } catch (\Exception $e) {
            return redirect()->route('environmentals.edit', $environmental->id)->with('error', $this->responseMessage->response('lingkungan', false, 'update'));
        }
    }

    public function destroy(Environmental $environmental)
    {
        try {
            $this->environmental->delete($environmental);

            return redirect()->route('environmentals.index')->with('success', $this->responseMessage->response('Lingkungan', true, 'delete'));
        } catch (\Exception $e) {         
            return redirect()->route('environmentals.index')->with('error', $this->responseMessage->response('lingkungan', false, 'delete'));
        }
    }
}
