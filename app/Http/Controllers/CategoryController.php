<?php

namespace App\Http\Controllers;

use App\Events\AttachmentEvent;
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
    $categories = \App\Models\Category::query()->with('icon')->get();

    return view('categories.index', compact('categories'));
  }

  public function create()
  {
    return view('categories.create');
  }

  public function store(Request $request)
  {
    $data     = $request->validate([
      'title' => 'required',
      'icon'  => 'required',
    ]);
    $category = \App\Models\Category::query()->create($data);

    event(new AttachmentEvent($request->icon, $category->icon(), 'categories'));

    return redirect()->route('categories.index');
  }

  public function edit(Category $category)
  {
    return view('categories.edit', compact('category'));
  }

  public function update(Category $category, Request $request)
  {
    $data = $request->validate([
      'title' => 'required',
      'icon'  => 'nullable',
    ]);

    $category->update($data);

    if ($request->has('icon')) {
      $this->attachmentService->destroy($category->icon);
      event(new AttachmentEvent($request->icon, $category->icon(), 'categories'));
    }

    return redirect()->route('categories.index');
  }

  public function destroy(Category $category)
  {
    $this->attachmentService->destroy($category->icon);

    $category->delete();

    return redirect()->route('categories.index');
  }
}
