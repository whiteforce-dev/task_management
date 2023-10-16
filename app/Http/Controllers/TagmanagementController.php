<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \App\Models\Tag;

class TagmanagementController extends Controller
{
    public function tagManagement()
    {
        return view('tag-pages.tag-create');
    }

    public function tagStore(request $request)
    {
        $request->validate([
            'tag_name' => 'required|tag_name|unique:tags,tag_name',
        ]);

        $tag = new Tag();
        $tag->tag_name = $request->tag_name;
        $tag->color = $request->color;
        $tag->software_catagory = Auth::user()->software_catagory;
        $tag->save();
        return redirect('tag-list')->with('success', 'Tag added successfull');
    }

    public function tagList()
    {
        $tags = Tag::orderBy('id', 'DESC')->get();
        return view('tag-pages.tag-list', compact('tags'));
    }
    public function editTag($id){   
        $tag = Tag::find($id);
        return view('tag-pages.tag-edit', compact('tag'));
    }
    public function TagEdit(request $request, $id){
    $tag = Tag::find($id);
    $tag->tag_name = $request->tag_name;
    $tag->color = $request->color;
    $tag->save();
    $tags = Tag::orderBy('id', 'DESC')->get();
    session()->flash('success', 'Tag Edit successful');
    return view('tag-pages.tag-list', compact('tags'));
    }
    public function deleteTag($id){
        $tag = Tag::find($id);
        $tag->delete();
        $tags = Tag::orderBy('id', 'DESC')->get();
        session()->flash('success', 'Tag Edit successful');
        return view('tag-pages.tag-list', compact('tags'));  
    }
}
