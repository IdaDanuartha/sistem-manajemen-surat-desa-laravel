<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Citizent;
use App\Models\Letter;
use App\Models\Sk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function getChartData()
    {
        if(auth()->user()->role === Role::ENVIRONMENTAL_HEAD) {
            // Get Data This Year
            $letterData = Sk::select(DB::raw("COUNT(*) as count"))
                    ->whereYear("created_at", date('Y'))
                    ->where('is_published', 1)				
                    ->groupBy(DB::raw("Month(created_at)"))
                    ->pluck("count");

            $months = Sk::select(DB::raw("Month(created_at) as month"))
                ->whereYear('created_at', date('Y'))
                ->where('is_published', 1)
                ->groupBy(DB::raw("Month(created_at)"))
                ->pluck("month");

            $letter_yearly = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,);
            foreach ($months as $index => $month) {
                $letter_yearly[$month - 1] = $letterData[$index];
            }
    
            // Get Data This Week
            $letter_weekly = [0, 0, 0, 0, 0, 0, 0];
    
            foreach ($letter_weekly as $key => $item) {
                $getLetterCurrentWeek = Sk::select(DB::raw("COUNT(*) as count"))
                                                ->whereDate('created_at', [Carbon::now()->startOfWeek()->addDays($key)->format('Y-m-d')])
                                                ->where('is_published', 1)
                                                ->groupBy(DB::raw("Date(created_at)"))
                                                ->pluck("count")
                                                ->toArray();
    
                $letter_weekly[$key] = count($getLetterCurrentWeek) ? $getLetterCurrentWeek[0] : 0;
            }	
    
            // Get Data This Month
            $letter_monthly = [0, 0, 0, 0];
    
            foreach ($letter_monthly as $key => $item) {
                $getLetterCurrentWeek = Sk::select(DB::raw("COUNT(*) as count"))
                ->whereBetween('created_at', [
                    Carbon::now()->startOfMonth()->addWeeks($key)->startOfWeek(),
                    Carbon::now()->startOfMonth()->addWeeks($key)->endOfWeek(),
                ])
                ->where('is_published', 1)
                ->groupBy(DB::raw("Week(created_at)"))
                ->pluck("count")
                ->toArray();
    
                $letter_monthly[$key] = count($getLetterCurrentWeek) ? $getLetterCurrentWeek[0] : 0;
            }
        } else if(auth()->user()->role === Role::SECTION_HEAD) {
            // Get Data This Year
            $letterData = Sk::select(DB::raw("COUNT(*) as count"))
                    ->whereYear("created_at", date('Y'))
                    ->where('status_by_environmental_head', 1)				
                    ->groupBy(DB::raw("Month(created_at)"))
                    ->pluck("count");

            $months = Sk::select(DB::raw("Month(created_at) as month"))
                ->whereYear('created_at', date('Y'))
                ->where('status_by_environmental_head', 1)
                ->groupBy(DB::raw("Month(created_at)"))
                ->pluck("month");
            
            $letter_yearly = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,);
            foreach ($months as $index => $month) {
                $letter_yearly[$month - 1] = $letterData[$index];
            }
    
            // Get Data This Week
            $letter_weekly = [0, 0, 0, 0, 0, 0, 0];
    
            foreach ($letter_weekly as $key => $item) {
                $getLetterCurrentWeek = Sk::select(DB::raw("COUNT(*) as count"))
                                                ->whereDate('created_at', [Carbon::now()->startOfWeek()->addDays($key)->format('Y-m-d')])
                                                ->where('status_by_environmental_head', 1)
                                                ->groupBy(DB::raw("Date(created_at)"))
                                                ->pluck("count")
                                                ->toArray();
    
                $letter_weekly[$key] = count($getLetterCurrentWeek) ? $getLetterCurrentWeek[0] : 0;
            }	
    
            // Get Data This Month
            $letter_monthly = [0, 0, 0, 0];
    
            foreach ($letter_monthly as $key => $item) {
                $getLetterCurrentWeek = Sk::select(DB::raw("COUNT(*) as count"))
                ->whereBetween('created_at', [
                    Carbon::now()->startOfMonth()->addWeeks($key)->startOfWeek(),
                    Carbon::now()->startOfMonth()->addWeeks($key)->endOfWeek(),
                ])
                ->where('status_by_environmental_head', 1)
                ->groupBy(DB::raw("Week(created_at)"))
                ->pluck("count")
                ->toArray();
    
                $letter_monthly[$key] = count($getLetterCurrentWeek) ? $getLetterCurrentWeek[0] : 0;
            }
        } else if(auth()->user()->role === Role::VILLAGE_HEAD) {
            // Get Data This Year
            $letterData = Sk::select(DB::raw("COUNT(*) as count"))
                    ->whereYear("created_at", date('Y'))
                    ->where('status_by_section_head', 1)				
                    ->groupBy(DB::raw("Month(created_at)"))
                    ->pluck("count");

            $months = Sk::select(DB::raw("Month(created_at) as month"))
                ->whereYear('created_at', date('Y'))
                ->where('status_by_section_head', 1)
                ->groupBy(DB::raw("Month(created_at)"))
                ->pluck("month");
            
            $letter_yearly = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,);
            foreach ($months as $index => $month) {
                $letter_yearly[$month - 1] = $letterData[$index];
            }
    
            // Get Data This Week
            $letter_weekly = [0, 0, 0, 0, 0, 0, 0];
    
            foreach ($letter_weekly as $key => $item) {
                $getLetterCurrentWeek = Sk::select(DB::raw("COUNT(*) as count"))
                                                ->whereDate('created_at', [Carbon::now()->startOfWeek()->addDays($key)->format('Y-m-d')])
                                                ->where('status_by_section_head', 1)
                                                ->groupBy(DB::raw("Date(created_at)"))
                                                ->pluck("count")
                                                ->toArray();
    
                $letter_weekly[$key] = count($getLetterCurrentWeek) ? $getLetterCurrentWeek[0] : 0;
            }	
    
            // Get Data This Month
            $letter_monthly = [0, 0, 0, 0];
    
            foreach ($letter_monthly as $key => $item) {
                $getLetterCurrentWeek = Sk::select(DB::raw("COUNT(*) as count"))
                ->whereBetween('created_at', [
                    Carbon::now()->startOfMonth()->addWeeks($key)->startOfWeek(),
                    Carbon::now()->startOfMonth()->addWeeks($key)->endOfWeek(),
                ])
                ->where('status_by_section_head', 1)
                ->groupBy(DB::raw("Week(created_at)"))
                ->pluck("count")
                ->toArray();
    
                $letter_monthly[$key] = count($getLetterCurrentWeek) ? $getLetterCurrentWeek[0] : 0;
            }
        } else {
            // Get Data This Year
            $letterData = Sk::select(DB::raw("COUNT(*) as count"))
                    ->whereYear("created_at", date('Y'))                    				
                    ->groupBy(DB::raw("Month(created_at)"))
                    ->pluck("count");

            $months = Sk::select(DB::raw("Month(created_at) as month"))
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
                $getLetterCurrentWeek = Sk::select(DB::raw("COUNT(*) as count"))
                                                ->whereDate('created_at', [Carbon::now()->startOfWeek()->addDays($key)->format('Y-m-d')])                                                
                                                ->groupBy(DB::raw("Date(created_at)"))
                                                ->pluck("count")
                                                ->toArray();
    
                $letter_weekly[$key] = count($getLetterCurrentWeek) ? $getLetterCurrentWeek[0] : 0;
            }	
    
            // Get Data This Month
            $letter_monthly = [0, 0, 0, 0];
    
            foreach ($letter_monthly as $key => $item) {
                $getLetterCurrentWeek = Sk::select(DB::raw("COUNT(*) as count"))
                ->whereBetween('created_at', [
                    Carbon::now()->startOfMonth()->addWeeks($key)->startOfWeek(),
                    Carbon::now()->startOfMonth()->addWeeks($key)->endOfWeek(),
                ])
                ->where('status_by_village_head', 1)
                ->groupBy(DB::raw("Week(created_at)"))
                ->pluck("count")
                ->toArray();
    
                $letter_monthly[$key] = count($getLetterCurrentWeek) ? $getLetterCurrentWeek[0] : 0;
            }
        }
        
        return [
            $letter_yearly,
            $letter_weekly,
            $letter_monthly,
        ];
    }

    public function __invoke(Request $request)
    {
        $letter_yearly = $this->getChartData()[0];
        $letter_weekly = $this->getChartData()[1];
        $letter_monthly = $this->getChartData()[2];

        $total_citizents = Citizent::count();
        $total_letters = Sk::count();

        if(auth()->user()->role === Role::ADMIN) {
            $total_letters_approved = Sk::where('status_by_village_head', 1)
                                            ->count();
            $total_letters_not_approved = Sk::where('status_by_village_head', 0)
                                                ->count();
        } else if(auth()->user()->role === Role::ENVIRONMENTAL_HEAD) {
            $total_letters_approved = Sk::where('environmental_head_id', auth()->user()->authenticatable->id)
                                            ->where('status_by_environmental_head', 1)
                                            ->count();
            $total_letters_not_approved = Sk::where('status_by_environmental_head', 0)
                                                ->count();
            $total_letters = Sk::where('is_published', 1)->count();
        } else if(auth()->user()->role === Role::SECTION_HEAD) {
            $total_letters_approved = Sk::where('section_head_id', auth()->user()->authenticatable->id)
                                            ->where('status_by_environmental_head', 1)
                                            ->count();
            $total_letters_not_approved = Sk::where('status_by_section_head', 0)
                                                ->where('status_by_environmental_head', 1)
                                                ->count();
            $total_letters = Sk::where('status_by_environmental_head', 1)->count();
        } else if(auth()->user()->role === Role::VILLAGE_HEAD) {
            $total_letters_approved = Sk::where('village_head_id', auth()->user()->authenticatable->id)
                                            ->where('status_by_section_head', 1)
                                            ->count();
            $total_letters_not_approved = Sk::where('status_by_village_head', 0)
                                                ->where('status_by_section_head', 1)
                                                ->count();
            $total_letters = Sk::where('status_by_section_head', 1)->count();
        } else if(auth()->user()->role === Role::SUPER_ADMIN) {
            $total_letters_approved = Sk::where('status_by_village_head', 1)->count();
            $total_letters_not_approved = Sk::where('status_by_village_head', 0)->count();
        } else {
            $total_letters_approved = Sk::where('citizent_id', auth()->user()->authenticatable->id)
                                            ->where('status_by_village_head', 1)
                                            ->count();
            $total_letters_not_approved = Sk::where('citizent_id', auth()->user()->authenticatable->id)
                                                ->where('status_by_village_head', 0)
                                                ->count();
            $total_letters = Sk::where('citizent_id', auth()->user()->authenticatable->id)->count();
        }

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
