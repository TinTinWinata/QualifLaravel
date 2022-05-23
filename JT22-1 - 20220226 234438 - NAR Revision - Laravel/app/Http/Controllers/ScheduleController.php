<?php

namespace App\Http\Controllers;

use App\Models\Allocation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    function index()
    {

        $data = array();
        $user = Auth::user();

        if ($user->role == 'student') {

            $allocationList = DB::table('allocation_details')
                ->where('student_code', '=', $user->student_code)
                ->get();
            $allocations = array();
            foreach ($allocationList as $curr) {
                $found = DB::table('allocations')
                    ->where('id', '=', $curr->allocation_id)
                    ->get()->toArray();
                foreach ($found as $currFound) {
                    array_push($allocations, $currFound);
                }
            }
        } else if ($user->role == 'lecturer') {
            $allocations = Allocation::where('lecturer_code', '=', $user->lecturer_code)->get();
        }



        $schedule = array();

        // Today Schedule
        foreach ($allocations as $curr) {
            $found = DB::table('schedules')
                ->where('allocation_id', '=', $curr->id)
                ->orderBy('date', 'asc')
                ->get()->toArray();

            if (!empty($found)) {
                foreach ($found as $curr2) {
                    $subject_name = DB::table('subjects')
                        ->where('subject_code', '=', $curr->subject_code)
                        ->get('subject_name')->first();
                    $curr2 = collect($curr2)->merge($subject_name);
                    array_push($schedule, $curr2->toArray());
                }
            }
        }
        $sortedSchedule = collect($schedule)->sortBy('date')->all();
        $data = [
            'schedule' => $sortedSchedule,
        ];
        // dd($data);
        return view('schedules', compact('data'));
    }
}
