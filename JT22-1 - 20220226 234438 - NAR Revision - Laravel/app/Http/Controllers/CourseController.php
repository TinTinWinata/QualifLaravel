<?php

namespace App\Http\Controllers;

use App\Models\Allocation;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        // dd(Auth::user());
        $user = Auth::user();
        if ($user->role == 'student') {
            $allocationList = DB::table('allocation_details')
                ->where('student_code', '=', $user->student_code)
                ->get();
            // dd($allocationList);
            $allocations = array();

            foreach ($allocationList as $curr) {
                $found = Allocation::where('id', '=', $curr->allocation_id)
                    ->get();
                foreach ($found as $currFound) {
                    array_push($allocations, $currFound);
                }
            }
        } else if ($user->role == 'lecturer') {
            $allocations = Allocation::where('lecturer_code', '=', $user->lecturer_code)->get();
        }
        // dd($allocations);
        return view('courses', compact('allocations'));
    }

    public function courseDetail($id)
    {
        $allocation = DB::table('allocations')
            ->where('id', '=', $id)
            ->first();

        $subject = DB::table('subjects')
            ->where('subject_code', '=', $allocation->subject_code)
            ->first();

        $lecturer = DB::table('lecturers')
            ->where('lecturer_code', '=', $allocation->lecturer_code)
            ->first();
        $assignment = array();
        $temp = DB::table('assignments')
            ->where('assignment_id', '=', $allocation->id)
            ->get();

        foreach ($temp as $curr) {
            $tempAl = Allocation::find($curr->allocation_id)->first();
            $lecturer = DB::table('lecturers')->where('lecturer_code', '=', $tempAl->lecturer_code)->first();
            $curr = collect($curr)->merge($lecturer);
            array_push($assignment, $curr->toArray());
        }

        $student = array();
        $allocation_details = DB::table('allocation_details')
            ->where('allocation_id', '=', $allocation->id)
            ->get();
        foreach ($allocation_details as $curr) {
            // dd($curr->student_code);
            $found = DB::table('users')->where('student_code', '=', $curr->student_code)->first();
            array_push($student, $found);
        }
        // dd($allocation_details);
        // dd($student);

        $data = [
            'allocation' => $allocation,
            'subject' => $subject,
            'lecturer' => $lecturer,
            'assignment' => $assignment,
            'student' => $student
        ];



        return view('coursedetail', compact('data'));
    }
}
