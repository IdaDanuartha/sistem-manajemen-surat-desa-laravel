<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Repositories\LetterRepository;
use App\Utils\ResponseMessage;
use Illuminate\Http\Request;

class LetterHistoryController extends Controller
{
    public function __construct(
        protected readonly LetterRepository $letterRepository,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {     
        $letters = $this->letterRepository->findLetterApproved();
        return view('dashboard.letters.history', compact('letters'));
    }

    public function show(Letter $history)
    {        
        $get_letter = $this->letterRepository->findById($history);
        return view('dashboard.letters.crud.detail', compact('get_letter'));
    }
}
