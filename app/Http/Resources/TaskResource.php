<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
  public function toArray($request): array|Arrayable|\JsonSerializable
  {
    return [
      'id'      => $this->resource->id,
      'title'   => $this->resource->title,
      'content' => $this->resource->content,
      'status'  => $this->resource->status,
      'date'    => $this->resource->created_at->format('d.m.Y | H:i:s'),
    ];
  }
}
