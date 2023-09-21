<?php

namespace App\Http\Controllers;

use App\Models\SocialLink;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class SocialLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SocialLink::get(['name', 'url'])->keyBy('name');
        return Inertia::render('Social/Edit', [
            'socialLinks' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        SocialLink::where('name', 'facebook')->update([
            'url'   => $request->facebook
        ]);

        SocialLink::where('name', 'linkedin')->update([
            'url'   => $request->linkedin
        ]);

        SocialLink::where('name', 'twitter')->update([
            'url'   => $request->twitter
        ]);

        SocialLink::where('name', 'vimeo')->update([
            'url'   => $request->vimeo
        ]);

        return Redirect::route('social-links.index')->with(['status' => 'success', 'message' => 'Social Link Updated Successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(SocialLink $socialLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SocialLink $socialLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SocialLink $socialLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialLink $socialLink)
    {
        //
    }
}
