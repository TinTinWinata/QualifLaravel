<?php

namespace App\Http\Controllers;

use App\Models\Allocation;
use App\Models\AllocationDetail;
use App\Models\Forum;
use App\Models\Reply;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ForumController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        if ($user->role == 'student') {

            $allocationList = DB::table('allocation_details')
                ->where('student_code', '=', $user->student_code)
                ->get();
            $allocations = array();
            $allocationDetails = AllocationDetail::where('student_code', '=', $user->student_code)->get();
            $forumList = new Collection();
            foreach ($allocationDetails as $curr) {
                $forums = Forum::where('allocation_id', '=', $curr->allocation_id)->get();
                foreach ($forums as $forum) {
                    $forumList->push($forum);
                }
            }
        } else if ($user->role == 'lecturer') {
            $allocations = Allocation::where('lecturer_code', '=', $user->lecturer_code)->get();
            $forumList = new Collection();
            foreach ($allocations as $curr) {
                $forums = Forum::where('allocation_id', '=', $curr->id)->get();
                foreach ($forums as $forum) {
                    $forumList->push($forum);
                }
            }
        }
        return view('forums', compact('forumList'));
    }
    public function forumDetail($id)
    {
        $forum = Forum::find($id);
        $reply = Reply::where('forum_id', '=', $id)->get();
        return view('forumdetail', compact('forum', 'reply'));
    }
    public function createReply(Request $req)
    {
        $req->validate(['reply' => 'required']);
        $reply = new Reply;

        $reply->content = $req->reply;
        $reply->user_id = Auth::user()->id;
        $reply->forum_id = $req->forum;
        // dd($reply);
        $reply->save();
        return redirect()->back();
        // $reply->content =p

    }
    public function deleteReply(Request $req)
    {
        Reply::find($req->id)->delete();
        return redirect()->back();
    }
}
