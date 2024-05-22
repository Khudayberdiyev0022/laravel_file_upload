<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\V1\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(): AnonymousResourceCollection
  {
    return CategoryResource::collection(Category::all());
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreCategoryRequest $request): CategoryResource
  {
    return CategoryResource::make(Category::query()->create($request->all()));
  }

  /**
   * Display the specified resource.
   */
  public function show(Category $category): CategoryResource
  {
    return CategoryResource::make($category);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateCategoryRequest $request, Category $category): CategoryResource
  {
    $category->update($request->all());

    return CategoryResource::make($category);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Category $category): JsonResponse
  {
    $category->delete();

    return response()->json(['message' => 'Category deleted!']);
  }
}
