<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Lecturer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LecturerController extends Controller
{
    public function restore(Request $req)
    {
        Lecturer::onlyTrashed()->where('lecturer_code', $req->id)->restore();
        return redirect('/lecturer');
    }

    function index()
    {
        $data = Lecturer::query()
            ->where('lecturer_code', 'like', '%' . request()->query('search') . '%')
            ->paginate(15);
        $deleted = Lecturer::onlyTrashed()->get();
        $email = array();
        foreach ($deleted as $curr) {
            $found = User::onlyTrashed()->where('lecturer_code', '=', $curr->lecturer_code)->first();
            array_push($email, $found);
        }
        // dd($email);
        return view('lecturer', compact('data', 'deleted', 'email'));
    }

    function create(Request $req)
    {
        $req->validate(
            [
                'lecturer_name' => 'required',
                'lecturer_code' => 'required',
            ]
        );
        $lecturer = new Lecturer();
        $lecturer->lecturer_name = $req->lecturer_name;
        $lecturer->lecturer_code = $req->lecturer_code;
        $lecturer->save();

        return redirect("/lecturer");
    }

    function delete(Request $req)
    {
        $user = DB::table('users')
            ->where('lecturer_code', '=', $req->lecturer_code)
            ->first();
        DB::table('replies')
            ->where('user_id', '=', $user->id)
            ->delete();
        User::where('lecturer_code', '=', $req->lecturer_code)
            ->delete();



        $found = DB::table('allocations')
            ->where('lecturer_code', '=', $req->lecturer_code)
            ->get();


        foreach ($found as $curr) {
            $forumList = Forum::where('allocation_id', '=', $curr->id)->get();
            foreach ($forumList as $forum) {
                DB::table('replies')->where('forum_id', '=', $forum->forum_id)->delete();
            }
            DB::table('allocation_details')
                ->where('allocation_id', '=', $curr->id)
                ->delete();
            DB::table('forums')
                ->where('allocation_id', '=', $curr->id)
                ->delete();
            DB::table('assignments')
                ->where('allocation_id', '=', $curr->id)
                ->delete();
            DB::table('schedules')
                ->where('allocation_id', '=', $curr->id)
                ->delete();
        }

        Lecturer::where('lecturer_code', '=', $req->lecturer_code)
            ->delete();

        return redirect()->back();
    }
    public function update(Request $req)
    {
        $req->validate([
            'lecturerCodeUpdate' => 'required',
            'lecturerNameUpdate' => 'required'
        ]);

        DB::table('lecturers')
            ->where('lecturer_code', '=', $req->lecturer_code)
            ->update([
                'lecturer_code' => $req->lecturerCodeUpdate,
                'lecturer_name' => $req->lecturerNameUpdate
            ]);
        return redirect('lecturer');
    }
}
