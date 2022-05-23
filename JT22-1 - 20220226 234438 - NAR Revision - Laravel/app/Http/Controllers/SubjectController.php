<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function restore(Request $req)
    {
        Subject::onlyTrashed()->where('subject_code', $req->id)->restore();
        return redirect('/subject');
        // dd($req);
    }
    function index()
    {
        $data = Subject::query()
            ->where('subject_code', 'like', '%' . request()->query('search') . '%')
            ->paginate(15);
        $deleted = Subject::onlyTrashed()->get();
        return view('subject', compact('data', 'deleted'));
    }

    function create(Request $req)
    {
        // dd($req);

        $req->validate(
            [
                'subject_name' => 'required',
                'subject_code' => 'required',
            ]
        );

        $subject = new subject();
        $subject->subject_code = $req->subject_code;
        $subject->subject_name = $req->subject_name;
        $subject->save();

        return redirect("/subject");
    }

    function delete(Request $req)
    {

        $found = DB::table('allocations')
            ->where('subject_code', '=', $req->subject_code)
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

        Subject::where('subject_code', '=', $req->subject_code)
            ->delete();

        return redirect()->back();
    }
    public function update(Request $req)
    {
        $req->validate(
            [
                'subjectCodeUpdate' => 'required',
                'subjectNameUpdate' => 'required'
            ]
        );
        DB::table('subjects')
            ->where('subject_code', '=', $req->subject_code)
            ->update([
                'subject_code' => $req->subjectCodeUpdate,
                'subject_name' => $req->subjectNameUpdate
            ]);
        return redirect('subject');
    }
}
