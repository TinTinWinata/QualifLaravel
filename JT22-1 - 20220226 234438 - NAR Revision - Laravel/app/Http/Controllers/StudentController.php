<?php

namespace App\Http\Controllers;

// use Faker\Generator as Faker;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function restore(Request $req)
    {
        User::onlyTrashed()->where('student_code', $req->id)->restore();
        return redirect('/student');
        // dd($req);
    }

    function index()
    {
        $data = User::query()
            ->where('student_code', 'like', '%' . request()->query('search') . '%')
            ->paginate(15);
        $deleted = User::onlyTrashed()->get();
        return view('student', compact('data', 'deleted'));
    }

    function create(Request $req)
    {
        // dd($req);


        $req->validate(
            [
                'student_name' => 'required',
                'student_email' => 'required',
            ]
        );

        $student = new User();
        $student->name = $req->student_name;
        $student->email = $req->student_email;
        $student->student_code = mt_rand(1000000000, 9999999999);
        $student->save();

        return redirect("/student");
    }

    function delete(Request $req)
    {
        $user = User::where('student_code', $req->student_code)->first();
        $asd = DB::table('replies')
            ->where('user_id', '=', $user->id)
            ->delete();

        DB::table('allocation_details')
            ->where('student_code', '=', $req->student_code)
            ->delete();

        User::where('student_code', '=', $req->student_code)
            ->delete();
        return redirect()->back();
    }
    public function update(Request $req)
    {
        $req->validate([
            'studentEmailUpdate' => 'required',
            'studentNameUpdate' => 'required'
        ]);

        DB::table('users')
            ->where('student_code', '=', $req->student_code)
            ->update([
                'email' => $req->studentEmailUpdate,
                'name' => $req->studentNameUpdate
            ]);
        return redirect('student');
    }
}
