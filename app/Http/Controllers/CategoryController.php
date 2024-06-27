<?php

namespace App\Http\Controllers;

use App\Events\AttachmentEvent;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
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
    $category        = new \App\Models\Category();
    $category->title = $request->title;
    $category->save();
    event(new AttachmentEvent($request->icon, $category->icon(), 'categories'));

    return redirect()->route('categories.index');
  }
}
