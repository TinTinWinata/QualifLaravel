<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Forum;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    public function restore(Request $req)
    {
        Classroom::onlyTrashed()->where('classroom', $req->id)->restore();
        return redirect('/classroom');
    }

    function index()
    {
        $data = Classroom::query()
            ->where('classroom', 'like', '%' . request()->query('search') . '%')
            ->paginate(15);

        $deleted = Classroom::onlyTrashed()->get();

        return view('classroom', compact('data', 'deleted'));
    }

    function create(Request $req)
    {
        $req->validate(
            [
                'name' => 'required',
            ]
        );
        $data = new Classroom();
        $data->classroom = $req->name;
        $data->save();

        return redirect("/classroom");
    }

    function delete(Request $req)
    {
        $found = DB::table('allocations')
            ->where('classroom', '=', $req->classroom)
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

        Classroom::where('classroom', $req->classroom)
            ->delete();

        return redirect()->back();
    }


    public function update(Request $req)
    {
        $req->validate(
            [
                'classroom' => 'required'
            ]
        );

        // dd($req->primary);

        DB::table('classrooms')
            ->where('classroom', '=', $req->primary)
            ->update(['classroom' => $req->classroom]);
        return redirect('classroom');
    }
}
