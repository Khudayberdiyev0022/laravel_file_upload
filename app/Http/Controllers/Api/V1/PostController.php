<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;

class PostController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $posts = Post::all();

    return response()->json($posts);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StorePostRequest $request)
  {
    $post = Post::query()->create($request->all());

    return response()->json($post, 201);
  }

  /**
   * Display the specified resource.
   */
  public function show(Post $post)
  {
    return response()->json($post);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdatePostRequest $request, Post $post)
  {
    $post->update($request->all());

    return response()->json($post);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Post $post)
  {
    $post->delete();

    return response()->json(['message' => 'Post deleted!']);
  }
}
