<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ShowImageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Image $image, Request $request)
    {
        $relatedImages = $image->relatedImages();

        // ! wrong way => $image->with('user')->comments()->latest()->get(); image_id = 1 => user = 1 => all of comments of user = 1 => comment [1, 8]

        $disableComment = $image->user->setting->disable_comments;

        // $comments = $disableComment ? [] : $image->comments()->with('user')->approved()->latest()->get(); // image_id = 1 => comments [1:7] => user [1:7]
        $comments =$image->comments()->with('user')->approved()->latest()->get();
        return view('image-show',
        compact('image', 'comments', 'disableComment', 'relatedImages'));
    }
}
