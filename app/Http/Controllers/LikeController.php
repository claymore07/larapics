<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Image $image, Request $request)
    {
        //
        if ($image->hasBeenLiked()) {
            $message = 'You have successfully un-liked the image!';
            $image->decrement('likes_count');
        } else {
            $message = 'You have successfully liked the image!';
            $image->increment('likes_count');
        }

        auth()->user()->likes()->toggle($image->id);

        return back()->with('message', $message);
    }
}
