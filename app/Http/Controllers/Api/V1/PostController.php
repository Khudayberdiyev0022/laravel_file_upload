<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\V1\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Route;

class PostController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(): AnonymousResourceCollection
  {
    return PostResource::collection(Post::with('category')->get());
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StorePostRequest $request): PostResource
  {
    $post = Post::query()->create($request->all());

    return PostResource::make($post);
  }

  /**
   * Display the specified resource.
   */
  public function show(Post $post): PostResource
  {
    return PostResource::make($post);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdatePostRequest $request, Post $post): PostResource
  {
    $post->update($request->all());

    return PostResource::make($post);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Post $post): JsonResponse
  {
    $post->delete();

    return response()->json(['message' => 'Post deleted!']);
  }
}
