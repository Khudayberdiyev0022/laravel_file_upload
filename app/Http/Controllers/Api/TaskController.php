<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
  public function index(Request $request): JsonResponse
  {
    $status = $request->input('status');
    $query = Task::query();

    if ($status) {
      $query->where('status', $status);
    }

    if ($request->input('search')) {
      $query->where('title', 'like',  $request->input('search') . '%');
    }

    $tasks = TaskResource::collection($query->get());
    try {
      return response()->json(['success' => true, 'message' => 'All tasks', 'data' => $tasks]);
    } catch (\Exception $e) {
      return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
  }

  public function store(StoreTaskRequest $request): JsonResponse
  {
    $data = $request->validated();

    try {
      $task = TaskResource::make(Task::query()->create($data));

      return response()->json(['success' => true, 'message' => 'Task created successfully', 'data' => $task], 201);
    } catch (\Exception $e) {
      return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
  }

  public function show(Task $task): JsonResponse
  {
    return response()->json(['success' => true, 'message' => 'Show task', 'data' => $task]);
  }

  public function update(StoreTaskRequest $request, Task $task): JsonResponse
  {
    $data = $request->validated();

    try {
      $task->update($data);

      return response()->json(['success' => true, 'message' => 'Task updated successfully', 'data' => $task], 201);
    } catch (\Exception $e) {
      return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
  }

  public function destroy(Task $task): JsonResponse
  {
    try {
      $task->delete();

      return response()->json(['success' => true, 'message' => 'Task deleted successfully', 'data' => []]);
    } catch (\Exception $e) {
      return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
  }
}
