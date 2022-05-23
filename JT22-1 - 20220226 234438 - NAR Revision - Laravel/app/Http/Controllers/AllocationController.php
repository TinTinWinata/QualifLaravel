<?php

namespace App\Http\Controllers;

use App\Models\Allocation;
use App\Models\Classroom;
use App\Models\Lecturer;
use App\Models\Subject;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllocationController extends Controller
{
    public function create(Request $req)
    {
        $allocation = new Allocation;
        $allocation->classroom = $req->classroom;
        $allocation->subject_code = $req->subject;
        $allocation->lecturer_code = $req->lecturer;
        $allocation->save();
        return redirect('/allocation');
    }
    public function restore(Request $req)
    {
        Allocation::onlyTrashed()->where('id', $req->id)->restore();
        return redirect('/allocation');
        // dd($req);
    }
    public function getAllocation()
    {
        $allocation = Allocation::query()
            // ->join('lecturers', 'allocations.lecturer_code', '=', 'lecturers.lecturer_code')
            ->where('lecturer_code', 'like', '%' . request()->query('search') . '%')
            ->orwhere('subject_code', 'like', '%' . request()->query('search') . '%')
            // ->orwhere('lecturer_name', 'like', '%' . request()->query('search') . '%')
            ->orwhere('classroom', 'like', '%' . request()->query('search') . '%')
            ->orwhere('created_at', 'like', '%' . request()->query('search') . '%')
            ->paginate(15);

        $allocationDeleted = Allocation::onlyTrashed()->get();
        return view('allocation', compact('allocation', 'allocationDeleted'));
    }
    public function delete(Request $req)
    {
        $found = Allocation::find($req->id);
        if (isset($found)) {
            $found->delete();
        }

        return redirect()->back();
    }

    public function updatePage($id)
    {
        $alloc = Allocation::find($id);
        return view('update', compact('alloc'));
    }

    public function updateForm(Request $req)
    {
        // dd($req);


        DB::table('lecturers')
            ->where('lecturer_code', '=', $req->lecturer_code)
            ->update(['lecturer_name' => $req->lecturerUpdate]);


        DB::table('subjects')
            ->where('subject_code', '=', $req->subject_code)
            ->update(['subject_name' => $req->subjectUpdate]);


        DB::table('classrooms')
            ->where('classroom', '=', $req->classroom)
            ->update(['classroom' => $req->classroomUpdate]);


        return redirect("/allocation");
    }
    public function indexCreate()
    {
        $subjectList = Subject::orderBy('subject_code')->get();
        $classroomList = Classroom::orderBy('classroom')->get();
        $lecturerList = Lecturer::orderBy('lecturer_code')->get();
        // dd($subjectList);
        return view('createAllocation', compact('subjectList', 'classroomList', 'lecturerList'));
    }
}
