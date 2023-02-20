<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ImageController extends Controller
{
    public function __construct(protected $perPage = 15)
    {
        $this->middleware(['auth']);

        $this->authorizeResource(Image::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images =
        Image::visibleFor(request()->user())
        ->latest()
        ->paginate($this->perPage)
        ->withQueryString();

        return view('image.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('image.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImageRequest $request)
    {
        //
        $image = Image::create($data = $request->getData());
        $image->syncTags($data['tags']); // mountain,sea,fire,camp

        return to_route('images.index')->with('message', 'Image has been uploaded Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        // return view('image.show', compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        // if (!Gate::allows('update-image', $image)) {
        //     abort(403, "Access denied");
        // }
        // Gate::authorize('update-image', $image);
        // $this->authorize('update', $image);
        //  if(request()->user()->cannot('update', $image)){
        //     abort(403, "Access Denied");
        // }
        return view('image.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(ImageRequest $request, Image $image)
    {
        // $this->authorize('update', $image);
        // if(request()->user()->cannot('update', $image)){
        //     abort(403, "Access Denied");
        // }

        $image->update($data = $request->getData());
        $image->syncTags($data['tags']);

        return to_route('images.index')->with('message', 'Image has been Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        // if (Gate::denies('delete', $image)) {
        //     abort(403, "Access denied");
        // }
        $image->delete();

        return to_route('images.index')->with('message', 'Image has been deleted Successfully!');
    }
}
