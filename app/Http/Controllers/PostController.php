<?php

namespace App\Http\Controllers;

use App\Events\AttachmentEvent;
use App\Models\Post;
use App\Services\AttachmentService;
use Illuminate\Http\Request;

class PostController extends Controller
{
  public function __construct(protected AttachmentService $attachmentService)
  {
  }

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
    $data = $request->validate([
      'name'   => 'required',
      'body'   => 'required',
      'images' => 'required',
    ]);
    $post = Post::query()->create($data);
    event(new AttachmentEvent($request->images, $post->images(), 'posts'));

    return redirect()->route('posts.index');
  }

  public function edit(Post $post)
  {
    return view('posts.edit', compact('post'));
  }

  public function update(Post $post, Request $request)
  {
    $data = $request->validate([
      'name'   => 'required',
      'body'   => 'required',
      'images' => 'nullable',
    ]);

    $post->update($data);

    if ($request->has('images')) {
      $this->attachmentService->destroy($post->images);
      event(new AttachmentEvent($request->images, $post->images(), 'posts'));
    }

    return redirect()->route('posts.index');
  }

  public function destroy(Post $post)
  {
    $this->attachmentService->destroy($post->images);
    $post->delete();

    return redirect()->route('posts.index');
  }
}
