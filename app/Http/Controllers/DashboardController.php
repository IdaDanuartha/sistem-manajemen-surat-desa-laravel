<?php

namespace App\Http\Controllers;

use App\Models\Citizent;
use App\Models\Letter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Get Data This Year
		$letterData = Letter::select(DB::raw("COUNT(*) as count"))
                                      ->whereYear("created_at", date('Y'))				
                                      ->groupBy(DB::raw("Month(created_at)"))
                                      ->pluck("count");

        $months = Letter::select(DB::raw("Month(created_at) as month"))
                ->whereYear('created_at', date('Y'))
                ->groupBy(DB::raw("Month(created_at)"))
                ->pluck("month");

        $letter_yearly = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,);
        foreach ($months as $index => $month) {
            $letter_yearly[$month - 1] = $letterData[$index];
        }

        // Get Data This Week
        $letter_weekly = [0, 0, 0, 0, 0, 0, 0];

        foreach ($letter_weekly as $key => $item) {
                $getLetterCurrentWeek = Letter::select(DB::raw("COUNT(*) as count"))
                ->whereDate('created_at', [Carbon::now()->startOfWeek()->addDays($key)->format('Y-m-d')])
                ->groupBy(DB::raw("Date(created_at)"))
                ->pluck("count")
                ->toArray();

                $letter_weekly[$key] = count($getLetterCurrentWeek) ? $getLetterCurrentWeek[0] : 0;
        }	

        // Get Data This Month
        $letter_monthly = [0, 0, 0, 0];

        foreach ($letter_monthly as $key => $item) {
            $getLetterCurrentWeek = Letter::select(DB::raw("COUNT(*) as count"))
                ->whereBetween('date', [
                        Carbon::now()->startOfMonth()->addWeeks($key)->startOfWeek(),
                        Carbon::now()->startOfMonth()->addWeeks($key)->endOfWeek(),
                ])
                ->groupBy(DB::raw("Week(date)"))
                ->pluck("count")
                ->toArray();

            $letter_monthly[$key] = count($getLetterCurrentWeek) ? $getLetterCurrentWeek[0] : 0;
        }	

        $total_citizents = Citizent::count();
        $total_letters_approved = Letter::where('approved_by_section_head', 1)
                                        ->count();
        $total_letters_not_approved = Letter::where('approved_by_section_head', 0)
                                            ->count();
        $total_letters = Letter::count();

        return view('dashboard.analytics.index', compact(
            'letter_yearly',
            'letter_monthly',
            'letter_weekly',
            'total_citizents',
            'total_letters_approved',
            'total_letters_not_approved',
            'total_letters'
        ));
    }
}
