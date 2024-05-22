<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id'            => $this->id,
      'title'         => $this->title,
      'content'       => $this->when($request->route()->getName() == 'posts.show', $this->content),
      'categoryId'    => $this->category->id,
      'categoryTitle' => $this->category->title,
      'created_at'    => Carbon::parse($this->created_at)->format('d.m.Y / H:i:s'),
    ];
  }
}
