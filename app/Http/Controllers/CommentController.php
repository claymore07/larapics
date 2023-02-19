<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use App\Models\Image;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CommentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index() :View
    {
        // 1) all of images posted by authenticated User
        // 2) Get all of the comments for above images
        $comments = Comment::forUser(auth()->user())->latest()->paginate(15);

        return view('comments.index', compact('comments'));
    }

    public function update(Comment $comment, Request $request) :RedirectResponse
    {
        $comment->approved = $request->approve;
        $comment->update();

        $message = "Comment has been " . ($request->approve ? "approved" : "unapproved");
        return back()->with('message', $message);
    }

    public function store(Image $image, CreateCommentRequest $request) :RedirectResponse
    {
        $image->comments()->create($request->getData());

        if($image->user->setting->moderate_comments){
            $message = "Your Comment is waiting for moderation. It will be visible after it has been approved!";
        }else {
            $message = "Your Comment has been successfully sent";
        }

        return back()->with('message', $message);
    }

    public function destroy(Comment $comment){
        $comment->delete();
        return back()->with('message', "Comment has been removed!");
    }
}
