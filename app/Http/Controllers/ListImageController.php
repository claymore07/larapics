<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Tag;
use Illuminate\Http\Request;

class ListImageController extends Controller
{
    private $perPage = 15;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, ?Tag $tag)
    {
        //
        $images =
        Image::
        published()
        ->where(function($query) use($tag){
            if($tag->id){
                $query->whereHas('tags', function($query) use ($tag){
                    $query->where('id', $tag->id);
                });
            }
        })
        ->latest()
        ->paginate($this->perPage)
        ->withQueryString();

        return view('image-list', compact('images'));
    }
}
