<?php

namespace App\Http\Controllers;

use App\Models\Allocation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
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
            $allocations = DB::table('allocations')
                ->where('lecturer_code', '=', $user->lecturer_code)
                ->get();
        }
        $today = array();

        // Today Schedule
        foreach ($allocations as $curr) {
            $found = DB::table('schedules')
                ->where('allocation_id', '=', $curr->id)
                ->whereDate('date', Carbon::today())
                ->get()->toArray();

            if (!empty($found)) {
                foreach ($found as $curr) {
                    array_push($today, $curr);
                }
            }
        }

        // Recent Forum
        $forum = array();

        foreach ($allocations as $curr) {
            $found = DB::table('forums')
                ->orderBy('created_at', 'asc')
                ->where('allocation_id', '=', $curr->id)
                ->get()->toArray();

            // dd($found);
            if (!empty($found)) {
                foreach ($found as $curr) {
                    $allocationFound = DB::table('allocations')
                        ->where('id', '=', $curr->allocation_id)
                        ->select('classroom', 'subject_code')
                        ->get()->first();


                    $subject = DB::table('subjects')
                        ->where('subject_code', '=', $allocationFound->subject_code)
                        ->get('subject_name')->first();

                    $merged = collect($curr)->merge($subject);
                    $merged = collect($merged)->merge($allocationFound);
                    array_push($forum, $merged->toArray());
                }
            }
        }


        // Recent Assignment

        $assignment = array();

        foreach ($allocations as $curr2) {
            $found = DB::table('assignments')
                ->orderBy('created_at', 'asc')
                ->where('allocation_id', '=', $curr2->id)
                ->get()->toArray();

            if (!empty($found)) {
                foreach ($found as $curr) {
                    $allocationForAssignment = DB::table('allocations')
                        ->where('id', '=', $curr->allocation_id)
                        ->select('classroom', 'subject_code', 'lecturer_code')
                        ->get()->first();


                    $subject = DB::table('subjects')
                        ->where('subject_code', '=', $allocationForAssignment->subject_code)
                        ->get('subject_name')->first();

                    $lecturer = DB::table('lecturers')
                        ->where('lecturer_code', '=', $allocationForAssignment->lecturer_code)
                        ->get('lecturer_name')->first();

                    $merged2 = collect($curr)->merge($subject);
                    $merged2 = collect($merged2)->merge($allocationForAssignment);
                    $merged2 = collect($merged2)->merge($lecturer);
                    array_push($assignment, $merged2->toArray());
                }
            }
            // dd($found);
        }

        // dd($assignment);
        $data = [
            'today' => $today,
            'forum' => $forum,
            'assignment' => $assignment,
        ];

        return view('dashboard', compact('data'));
    }
}
