<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoginRequest;
use App\Http\Requests\StoreRegisterRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
  public function register(StoreRegisterRequest $request): Model|Builder
  {
    return User::query()->create([
      'name'     => $request->name,
      'email'    => $request->email,
      'password' => bcrypt($request->password),
    ]);
  }

  public function login(StoreLoginRequest $request): JsonResponse
  {
    if (!auth()->attempt($request->only('email', 'password'))) {
      return response()->json(['message' => 'Unauthorized'], 401);
    } else {
      $user  = auth()->user();
      $token = $user->createToken('token')->plainTextToken;

      return response()->json(['token' => $token]);
    }
  }

  public function logout(Request $request): JsonResponse
  {
    $user = $request->user();
    $user->currentAccessToken()->delete();

    return response()->json(['message' => 'Logged out successfully']);
  }
}
