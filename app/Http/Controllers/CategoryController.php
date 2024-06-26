<?php

namespace App\Http\Controllers;

use App\Events\AttachmentEvent;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\AttachmentService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  public function __construct(protected AttachmentService $attachmentService)
  {
  }
  public function index()
  {
    return response()->json(CategoryResource::collection(Category::with('icon')->get()));
  }
  public function store(Request $request)
  {
    $category = new Category();
    $category->title = $request->title;

    $category->save();

    event(new AttachmentEvent($request->icon, $category->icon(), 'categories'));

    return response()->json($category, 201);
  }
  public function show(string $id)
  {
  }

  public function update(Request $request, string $id)
  {
  }

  public function destroy(string $id)
  {
    $category = Category::findOrFail($id);
    $this->attachmentService->destroy($category->icon);
    $category->delete();

    return response()->json([
      'message' => 'Success'
    ]);
  }
}
