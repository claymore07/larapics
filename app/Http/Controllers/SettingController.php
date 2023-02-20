<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingRequest;
use Illuminate\View\View;

class SettingController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function edit(): View
    {
        return view('setting', ['user' => auth()->user()]);
    }

    public function update(UpdateSettingRequest $request)
    {
        // dd($request->all());
        $request->user()->updateSettings($request->getData());

        return back()->with('message', 'Your changes have been saved!');
    }
}
