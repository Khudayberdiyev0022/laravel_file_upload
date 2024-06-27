<?php

namespace App\Http\Controllers;

use App\Events\AttachmentEvent;
use Illuminate\Http\Request;

class PostController extends Controller
{
  public function index()
  {
    $posts = \App\Models\Post::query()->with('images')->get();

    return view('posts.index', compact('posts'));
  }

  public function create()
  {
    return view('posts.create');
  }

  public function store(Request $request)
  {
    $post       = new \App\Models\Post();
    $post->name = $request->name;
    $post->body = $request->body;
    $post->save();
    event(new AttachmentEvent($request->images, $post->images(), 'posts'));

    return redirect()->route('posts.index');
  }
}
