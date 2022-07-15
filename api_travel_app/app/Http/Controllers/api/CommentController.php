<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public static function fc_get_comment(Request $request)
    {
        $tour_id = $request->input('tour_id');
        $get_comment = Comment::with('username')->where('tour_id', $tour_id)->orderBy('id', 'desc')->get();
        $data = [];
        foreach ($get_comment as $cmt) {
            $time = $cmt->created_at->diffForHumans();
            $data[] = $cmt->setAttribute('time', $time);
        }
        return response()->json($data);
    }

    public static function fc_write_comment(Request $request)
    {
        $user_id = Auth()->user()->id;
        $tour_id = $request->input('tour_id');
        if ($tour_id) {
            $comment = Comment::create([
                'user_id' => $user_id,
                'tour_id' => $request["tour_id"],
                'comment' => $request["comment"]
            ]);
            return response()->json($comment);
        } else {
            return response()->json(['message' => 'not found tour']);
        }
    }

    public function fc_create_emonotions(Request $request)
    {
        $tour_id = $request->input('tour_id');
        $comment_id = $request->input('comment_id');
        $get_comment = Comment::where('id', $comment_id)->select('count_like', 'id as comment_id')->first();
        $like = $request["like"];

        $cmt = Comment::find($comment_id);
        if ($like === 1) {
            $count = ++$get_comment->count_like;
            if ($cmt) {
                $cmt->count_like = $count;
                $cmt->save();
                return response()->json([
                    'comment_id' => $cmt->id,
                    'comment' => $cmt->comment,
                    'like' => $cmt->count_like
                ]);
            } else {
                return respone()->json(["message" => "not found this comment"]);
            }
        } elseif ($like === 0) {
            $count = --$get_comment->count_like;
            if ($cmt) {
                $cmt->count_like = $count;
                $cmt->save();
                return response()->json([
                    'comment_id' => $cmt->id,
                    'comment' => $cmt->comment,
                    'like' => $cmt->count_like
                ]);
            } else {
                return respone()->json(["message" => "not found this comment"]);
            }
        }
    }
}