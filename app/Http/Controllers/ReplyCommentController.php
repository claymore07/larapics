<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReplyCommentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function create(Comment $comment) :View
    {
        return view('comments.reply', compact('comment'));
    }

    public function store(Comment $comment, ReplyCommentRequest $request){
        $comment->approved = true;
        $comment->update();

        $reply = Comment::create($request->getData());
        $reply->approved = true;
        $reply->update();

        return to_route('comments.index')->with('message', "Your reply has been sent!");
    }
}
