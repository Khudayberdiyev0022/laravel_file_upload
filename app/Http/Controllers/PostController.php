<?php

namespace App\Http\Controllers;

use App\Events\AttachmentEvent;
use App\Http\Resources\PostResource;
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
    return response()->json(PostResource::collection(Post::with('images')->get()));
  }

  public function store(Request $request)
  {
    $post       = new Post();
    $post->name = $request->name;
    $post->body = $request->body;
    $post->save();
    event(new AttachmentEvent($request->images, $post->images(), 'posts'));

    return response()->json([
      'message' => 'Success',
    ]);
  }

  public function show(string $id)
  {
    //
  }

  public function update(Request $request, string $id)
  {
    //
  }

  public function destroy(string $id)
  {
    $post = Post::findOrFail($id);
    $this->attachmentService->destroy($post->images);
    $post->delete();

    return response()->json([
      'message' => 'Success',
    ]);
  }
}
